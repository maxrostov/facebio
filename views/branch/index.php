<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <h1>Подразделения</h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'ui green small button']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class'=>'ui selectable celled table'],
     //   'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => '',
                'format' => 'raw',
                // here comes the problem - instead of parent_region I need to have parent
                'value' => function ($dataProvider) {
                    $a = '<a style="font-size: 150%;" href="/branch/update?id='.$dataProvider->id.
                    '">'.$dataProvider->title.'</a>';
                    return $a;
                },
            ],

            'info:ntext',

         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
