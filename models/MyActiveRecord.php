<?php


namespace app\models;


class MyActiveRecord extends \yii\db\ActiveRecord
{
    public static function getDb()

    {
        if (php_sapi_name() == "cli") // запускаем из консоли общение со сканером
        {
            return \Yii::$app->db;
        } elseif (isset(\Yii::$app->user->identity) AND \Yii::$app->user->identity->username == 'admin') {
            return \Yii::$app->db;
        } else {

        }
        return \Yii::$app->db_user;

    }

}