<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\widgets\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>

    <?= \app\controllers\PersonController::showPersonHeader($model->id,'docs'); ?>
    <div class="ui bottom attached segment">
        <a href="/doc/create?person_id=<?= $model->id ?>" class="ui tiny green button">Создать документ</a>
        <div class="ui hidden divider"></div>
        <div class="ui horisontal "></div>
        <div class="ui three stackable cards">
            <?php foreach ($docs as $doc) { ?>

                <a class="ui card" href="/doc/update?id=<?= $doc->id ?>">
                    <?php if ($doc->doc_scan) { ?>
                        <div class="image">
                            <img src="/uploads/doc/<?= $doc->doc_scan ?>">
                        </div>
                    <?php } ?>
                    <div class="content">
                        <div class="header"> <?= $doc->type() ?></div>
                        <div class="meta">
                            <span class="category"> <?php if ($doc->is_primary) echo 'Основной' ?></span>
                        </div>
                        <div class="description">
                            <?= $doc->issued_by ?> <?= $doc->issued_date ?> <br>
                            <?= $doc->serial ?> <?= $doc->number ?>
                            <?= $doc->registration ?> <?= $doc->info ?>

                        </div>
                    </div>
                    <div class="extra content">
                        <div class="floated author">
                            <?php if ($doc->doc_scan) { ?>
                                <span class="right floated">
                            <i class="address card icon"></i>скан документа
                            </span>
                            <?php } ?>
                            <?= $doc->status() ?>

                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>


 </div>
