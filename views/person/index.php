<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a href="/person/create" class="ui labeled icon tiny green button"><i class="plus icon"></i>Создать клиента</a>
    </p>

<table class="ui striped selectable celled table">
    <thead>
    <th>Имя</th>
    <th>Статус</th>
    <th>Имя в сканере</th>
    <th>Биометрия</th>
    </thead>
   <?php foreach($persons as $person){ ?>
       <tr>
           <td><?php
             echo  $a = '<a href="/person/view?id='.$person->id.
                   '"><div style="width: 40px;height: 50px;float: left;margin-right: 5px;
                       background-image: url(/uploads/photo/'.$person->photo().');background-size: cover;"></div>
<span style="font-size: 150%;">'.$person->surname.'</span><br> '.
                   $person->name.' '.$person->patronymic.'</a>';
               ?></td>
           <td><?php echo $person->status[$person->status_id] ?></td>
           <td>
               <?php
              echo $person->name_scanner; ?>
           </td>
           <td>
               <?php
               $face_icon = ($person->face_data) ? '<i title="биометрия лицо" class="ui smile outline icon"></i>':  '';
               $finger_icon = ($person->finger_data) ? '<i title="биометрия пальцы"  class="ui thumbs up outline icon"></i>':  '';
               echo $finger_icon.' '.$face_icon; ?>
           </td>
       </tr>
    <?php } ?>
</table>

</div>
