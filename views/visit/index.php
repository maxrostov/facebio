<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VisitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Визиты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
 <?php //= Html::a('Create Visit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
    'tableOptions' => ['class'=>'ui selectable celled table'],
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],


            ['attribute'=>'Имя','value'=>'person.name'],
            ['attribute'=>'Фамилия','value'=>'person.surname'],
            'visited_at',
            'auth_type',

//           ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
