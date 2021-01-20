<?php

namespace app\models;

use Yii;


class Org extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'org';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title','info','inn','ogrn','kpp','address','email','phones'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'info' => 'Полное название',
            'inn' => 'ИНН',
            'ogrn' => 'ОГРН',
            'kpp' => 'КПП',
            'address' => 'Адрес',
            'email' => 'email',
            'phones' => 'Телефоны',
                ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasMany(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * {@inheritdoc}
     * @return DocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrgQuery(get_called_class());
    }
}
