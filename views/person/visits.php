<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\widgets\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>

    <?= \app\controllers\PersonController::showPersonHeader($model->id,'visits'); ?>
<div  class="ui bottom attached segment">

    <script>
        var visits_events=[<?=$js_visits?>];
    </script>
    <div id="calendar" style="max-width: 613px;"></div>

    <table class="ui very compact selectable table">
     <thead>
     <tr>
         <th>Дата, время</th>
         <th>Тип доступа</th>
     </tr></thead>

    <?php foreach ($visits as $visit) { ?>
        <tr>
            <td><?php echo $visit->visited_at; ?></td>
            <td><?php echo $visit->type(); ?></td></tr>


    <?php } ?>
    </table>
 </div>
