<?php

namespace app\controllers;

use app\models\Doc;
use app\models\Person;
use app\models\Visit;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    public static function showPersonHeader($id, $active_id = '')
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Person::findOne($id),
        ]);

//      return 'IVANOV IVAN IVANOVICH';//$dataProvider->surname;
        // TODO найти статичный метод рендринга
        return Yii::$app->controller->renderPartial('/person/_person_header', [
            'person' => Person::findOne($id), //$dataProvider,
            'active' => $active_id,
            'id' => $id,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $persons = Person::find()->orderBy(['surname' => SORT_ASC])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Person::find()->orderBy(['surname' => SORT_ASC]),
        ]);

        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'persons' => $persons
        ]);
    }

    /**
     * Displays a single Person model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $documents = new ActiveDataProvider([
            'query' => Doc::find()->where(['person_id' => $id]),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);


        return $this->render('view', [
            'model' => $this->findModel($id),


        ]);

    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDocs($id)
    {

        $documents = new ActiveDataProvider([
            'query' => Doc::find()->where(['person_id' => $id]),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);


        return $this->render('docs', [
            'model' => $this->findModel($id),
            'documents' => $documents,
            'docs' => Doc::find()->where(['person_id' => $id])->all(),


        ]);

    }

    public function actionVisits($id)
    {
        $visits = new ActiveDataProvider([
            'query' => Visit::find()->where(['person_id' => $id]),
            'pagination' => [
                'pageSize' => 150,
            ],
        ]);

        $all_visits = Visit::find()->where(['person_id' => $id])->all();

        $js_visits = '';
        foreach ($all_visits as $visit) {
//            $time = date('H:i',strtotime($visit->visited_at));
            $title = $visit->type_short();
           $js_visits.= "{title:'$title',start:'$visit->visited_at'},";
        }

        return $this->render('visits', [
            'model' => $this->findModel($id),
            'visits' => $all_visits,
            'js_visits'=>$js_visits]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();
        $model->scanner_task = "INSERT";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->name_scanner = $model->translitName();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


// https://github.com/samdark/yii2-cookbook/blob/master/book/forms-uploading-files.md

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $this->handleSave($model);

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function handleSave(Person $model)
    {

//        $model->name_scanner = $this->transliterate($model->surname.$model->name[0].$model->patronymic[0]);

        if ($model->load(Yii::$app->request->post())) {
            $model->upload = UploadedFile::getInstance($model, 'upload');
            if ($model->validate()) {
                if ($model->upload) {
                    $new_name = $model->id . '.' . $model->upload->extension;
                    if ($model->upload->saveAs('uploads/photo/' . $new_name)) {
                        $model->photo = $new_name;
                    }
                } elseif ($model->del_upload) {

                    $model->photo = NULL;
                }

// формируем (или переписываем при редактировании) имя в сканнере
//                    $name_scanner = $this->translit($model->surname .'_'.$model->name);
                $model->name_scanner = $model->translitName();

             if($model->status > 2)   $model->scanner_task = 'DISABLE';

                if ($model->save(false)) {
                    return $this->redirect(['person/view', 'id' => $model->id]);
                }
            }
        }
    }

//    public function actionAnketa($id)
//    {
//
//      return $this->render('anketa', [
//            'model' => $this->findModel($id),
//         ]);
//
//    }

    public function actionAnketa($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['anketa', 'id' => $model->id]);
        }

        return $this->render('anketa', [
            'model' => $model,
        ]);
    }

    public function actionAnketa_p($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['anketa', 'id' => $model->id]);
        }

        return $this->render('anketa_print', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDel_face($id)
    {

        $model = $this->findModel($id);
        $model->face_data='';
        $model->save();

        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionDel_finger($id)
    {

        $model = $this->findModel($id);
        $model->finger_data='';
        $model->save();

        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionTest()
{
$new_person = Person::find()->where("scanner_task= 'INSERT' OR scanner_task = 'DISABLE'")->all();

echo '<pre>';
var_dump($new_person);
}
    public function actionTranslit()
    {
        $rows = Person::find()->all();

        if (!empty($rows)) {

            foreach ($rows as $row) {
                echo $row->name_scanner = Person::translit($row->surname . "_" . $row->name);
                $row->save();
                echo '<br>';
            }
        }
        }

    }
