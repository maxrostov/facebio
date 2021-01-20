<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Редактировать: ' . $model->name ." ".$model->surname;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="person-update">

    <?=\app\controllers\PersonController::showPersonHeader($model->id,'view'); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
