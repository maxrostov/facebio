<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'is_primary') ?>

    <?php // echo $form->field($model, 'is_helped') ?>

    <?php // echo $form->field($model, 'issued_by') ?>

    <?php // echo $form->field($model, 'issued_date') ?>

    <?php // echo $form->field($model, 'serial') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'registration') ?>

    <?php // echo $form->field($model, 'info') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
