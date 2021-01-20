<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\widgets\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>

    <?= \app\controllers\PersonController::showPersonHeader($model->id,'view'); ?>
    <div  class="ui bottom attached segment">
    <a href="/person/update?id=<?=$model->id?>" class="ui labeled icon tiny green button"><i class="edit icon"></i>Редактировать</a>

    <?php if(Yii::$app->user->identity->username=='admin') { ?>
        <?php echo Html::a('<i class="x icon"></i>Удалить клиента', ['delete', 'id' => $model->id], [
            'class' => 'ui right floated tiny orange labeled icon button',
            'data' => [
                'confirm' => 'Действительно УДАЛИТЬ этого клиента?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if($model->finger_data) echo Html::a('<i class="thumbs up icon"></i>Удалить биометрию пальцев', ['del_finger', 'id' => $model->id], [
            'class' => 'ui right floated tiny teal labeled icon button',
            'data' => [
                'confirm' => 'Действительно УДАЛИТЬ биометрию пальцев этого клиента?',
                'method' => 'post',
            ],
        ]);
        else echo '<div class="ui right floated tiny disabled button">Биометрии пальцев нет</div>';
        ?>
        <?php if($model->face_data) echo Html::a('<i class="smile icon"></i>Удалить биометрию лица', ['del_face', 'id' => $model->id], [
            'class' => 'ui right floated tiny teal labeled icon button',
            'data' => [
                'confirm' => 'Действительно УДАЛИТЬ биометрию лица этого клиента?',
                'method' => 'post',
            ],
        ]);
        else echo '<div class="ui right floated tiny disabled button">Биометрии лица нет</div>';
        ?>



    <?php } ?>
        <table class='ui striped selectable celled table'>
              <?php
            $bio_rows = json_decode($model->bio_rows) ?? [];
            $reg_rows = json_decode($model->reg_rows) ?? [];

            // передаем весь массив биографии, находим где человек был в 1992г (т.е. первая подходящая позиция)
            function find_year($bio_rows,$year){
                $find = strtotime("$year-01-01");
               foreach ($bio_rows as $row){
                   if ($find < strtotime($row->date2)) return $row->address;
               }
            }
            ?>
            <tr>
                <td>Дата и место рождения</td>
                <td><?= $model->birthdate ?> <?= $model->birth_place ?>
                    <?php
                   if ($bio_rows) echo(current($bio_rows)->address)
                    ?>
                </td>
            </tr>
            <tr>
                <td>В 1992 году проживал</td>
                <td><?= $model->location92 ?>
                <?php echo find_year($bio_rows,'1992') ?></td>
            </tr>
            <tr>
                <td>В 2002 году проживал</td>
                <td>
                    <?php echo find_year($bio_rows,'2002') ?></td>
            </tr>
            <tr>
                <td>Из какого населенного пункта вы приехали</td>
                <td><?= $model->came_from ?>
                    <?php
                    if ($bio_rows) echo(end($bio_rows)->address) ?>
                </td>
            </tr>
            <tr><td colspan="2"><b>Биография</b></td>
       </tr>

            <?php
            // format date
            function d($date){
                $d = strtotime($date);
                return date('d/m/y',$d);
            }

            foreach($bio_rows as $bio){ ?>
          <tr>    <td><?php echo d($bio->date1). '&mdash;' .d($bio->date2) ?></td>
                <td><?=$bio->org?><br> <?=$bio->address ?></td>
          </tr>
            <?php } ?>

            <tr><td colspan="2"><b>Прописка</b></td></tr>

            <?php foreach($reg_rows as $reg){ ?>
                <tr>    <td><?php echo d($reg->date1). '&mdash;' .d($reg->date2) ?></td>
                    <td><?=$reg->address ?></td>
                </tr>
            <?php } ?>

        </table>


</div>
