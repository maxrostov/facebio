<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать документ', ['create'], ['class' => 'ui green button']) ?>
    </p>






    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'ui selectable celled table'],
        'columns' => [

            [
                'label' => 'Персона', 'format' => 'raw',
                     'value' => function ($d) {
                    return "<a href=/doc/update?id=$d->id>".$d->person->surname.
                        ' '. $d->person->name.'</a>';
                },
            ],
            [
                'label' => 'Документ',
                'value' => function ($d) {
                    return $d->type[$d->type_id];
                },
            ],
            [
                'label' => 'Статус',
                'value' => function ($d) {
                    return $d->status[$d->status_id];
                },
            ],
            //'is_primary',
            //'is_helped',
            //'issued_by',
            //'issued_date',
            //'serial',
            //'number',
            //'registration',
            //'info',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
