<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Doc */

$this->title = 'Создать документ';
//$this->params['breadcrumbs'][] = ['label' => 'Docs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-create">

    <?=\app\controllers\PersonController::showPersonHeader($model->person_id,'docs'); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
