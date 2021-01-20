<?php

namespace app\controllers;

use Yii;
use app\models\Doc;
use app\models\DocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DocController implements the CRUD actions for Doc model.
 */
class DocController extends Controller
{
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
     * Lists all Doc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doc model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Doc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Doc();

        $model->person_id = Yii::$app->request->get('person_id');
        $model->type_id = 0; //паспорт

        $this->handleSave($model);

//        if ($model->load(Yii::$app->request->post())) {
//            $model->doc_scan = UploadedFile::getInstance($model, 'doc_scan');
//            $model->doc_scan->saveAs('uploads/' . $model->doc_scan->baseName . '.' . $model->doc_scan->extension);
//
//            $model->save();
//            return $this->redirect(['person/view', 'id' => $model->person_id]);
//        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Doc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
////        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//        if ($model->load(Yii::$app->request->post())) {
//             var_dump($model->doc_scan);            die('====');
//            $uploaded = UploadedFile::getInstance($model, 'doc_scan');
//            if ($uploaded) {
//                $model->doc_scan = $uploaded->name;
//                $uploaded->saveAs('uploads/' . $uploaded->name);
//
//            } elseif (Yii::$app->request->post('del_doc_scan')) {
//                $model->doc_scan = '';
//            }
//            $model->save();
//
//            return $this->redirect(['person/view', 'id' => $model->person_id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//    }

// https://github.com/samdark/yii2-cookbook/blob/master/book/forms-uploading-files.md
    protected function handleSave(Doc $model)
    {
        if ($model->load(Yii::$app->request->post())) {
            $model->upload = UploadedFile::getInstance($model, 'upload');
//            die('==='.$model->del_doc_scan);

            if ($model->validate()) {
                if ($model->upload) {
//                    $filePath =  'uploads/'. $model->upload->baseName . '.' . $model->upload->extension;
  $new_name = $model->person_id.'_'.$model->type_id.'_'.$model->status_id.'.'.$model->upload->extension;
                    if ($model->upload->saveAs('uploads/doc/'.$new_name)) {
                        $model->doc_scan = $new_name;
                    }
                }
                elseif ($model->del_doc_scan){

                    $model->doc_scan = '';
                }

                if ($model->save(false)) {
                    return $this->redirect(['person/docs', 'id' => $model->person_id]);
                }
            }
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->handleSave($model);

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['person/view', 'id' => $model->person_id]);
//        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Doc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model =  $this->findModel($id);
       $person_id = $model->person_id;
        $model->delete();

//        return $this->redirect(['index']);
        return $this->redirect(['person/docs', 'id' => $person_id]);

    }

    /**
     * Finds the Doc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
