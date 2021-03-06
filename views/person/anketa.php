<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = 'Редактировать анкету: ' . $model->name ." ".$model->surname;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div>

    <?=\app\controllers\PersonController::showPersonHeader($model->id,'anketa'); ?>

    <?= $this->render('_form_anketa', [
        'model' => $model,
    ]) ?>

</div>
