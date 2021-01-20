<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Doc */

$this->title = 'Редактировать документ: ' . $model->type();
$this->params['breadcrumbs'][] = ['label' => 'Документ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="doc-update">
    <?=\app\controllers\PersonController::showPersonHeader($model->person_id,'docs'); ?>

<!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
