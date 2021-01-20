<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\widgets\ActiveField;
use app\models\Person;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Doc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-form">
    <?php $form = ActiveForm::begin(
        ['options' =>
            ['class' => 'ui form', 'enctype' => 'multipart/form-data']
        ]
    ); ?>
    <div class="two fields">
        <?= $form->field($model, 'type_id')->dropDownList($model->types) ?>
        <?= $form->field($model, 'status_id')->dropDownList($model->statuses) ?>
    </div>

    <div class="two fields">
        <?= $form->field($model, 'issued_by')->textInput(['maxlength' => true,'class'=>'js-dadata_fms']) ?>
        <?= $form->field($model, 'registration')->textInput(['maxlength' => true,'class'=>'js-dadata_address']) ?>
    </div>

    <div class="three fields">
        <?= $form->field($model, 'issued_date')->textInput(['type' => 'date']) ?>
        <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
    </div>





    <?= $form->field($model, 'is_helped')->checkbox() ?>
    <?= $form->field($model, 'is_primary')->checkbox() ?>
    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'upload')->fileInput() ?>
    <?php if ($model->doc_scan) { ?>
        <?= $form->field($model, 'del_doc_scan')->checkbox() ?>
        <img onclick="$('#doc_popup').modal('show');" src="/uploads/doc/<?=$model->doc_scan?>" style="width: 50%;margin-bottom: 20px;">

        <div id="doc_popup" class="ui small modal">
            <div class="header"><?=$model->type() ?></div>
            <div class="image content">
                <img  class="ui fluid image" src="/uploads/doc/<?=$model->doc_scan?>">
            </div>
        </div> <br clear="all">
    <?php } ?>
    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'ui green button']) ?>

    <?php if(Yii::$app->user->identity->username=='admin') { ?>

    <?php echo Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'ui red right floated  button',
        'data' => [
            'confirm' => 'Действительно УДАЛИТЬ этот документ?',
            'method' => 'post',
        ],
    ]) ?>
<?php } ?>
    <?php ActiveForm::end(); ?>


</div>
