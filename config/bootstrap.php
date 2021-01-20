<?php

namespace common\modules;

use yii\base\BootstrapInterface;
use yii;


class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$container->set(\yii\grid\GridView::className(), \Zelenin\yii\SemanticUI\widgets\GridView::className());
         Yii::$container->set(\yii\widgets\ActiveForm::className(), \Zelenin\yii\SemanticUI\widgets\ActiveForm::className());
//        Yii::$container->set(\yii\bootstrap\ActiveForm::className(), \Zelenin\yii\SemanticUI\widgets\ActiveForm::className());

        Yii::$container->set(\yii\widgets\Breadcrumbs::className(), \Zelenin\yii\SemanticUI\collections\Breadcrumb::className());
        Yii::$container->set(\yii\grid\CheckboxColumn::className(), \Zelenin\yii\SemanticUI\widgets\CheckboxColumn::className());
        Yii::$container->set(\yii\widgets\DetailView::className(), \Zelenin\yii\SemanticUI\widgets\DetailView::className());

    }
}