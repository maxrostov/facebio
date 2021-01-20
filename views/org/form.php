<?php
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;
?>

<h3>Организация</h3>

<?php $form = ActiveForm::begin(
    ['options' =>
        ['class' => 'ui form', 'enctype' => 'multipart/form-data']
    ]
); ?>


<?=$form->field($model, 'title')->textInput() ?>
<?=$form->field($model, 'info')->textInput() ?>
<?=$form->field($model, 'address')->textInput() ?>
<?=$form->field($model, 'inn')->textInput() ?>
<?=$form->field($model, 'ogrn')->textInput() ?>
<?=$form->field($model, 'kpp')->textInput() ?>
<?=$form->field($model, 'email')->textInput() ?>
<?=$form->field($model, 'phones')->textInput() ?>

<?= Html::submitButton('Сохранить', ['class' => 'ui right floated green button']) ?>


<?php ActiveForm::end(); ?>

