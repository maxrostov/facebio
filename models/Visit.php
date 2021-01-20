<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property int $person_id Персона
 * @property string $visited_at Дата 
 * @property string $auth_type Тип доступа
 * @property int $trans_id
 * @property int $log_id
 */
class Visit extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'visited_at', 'auth_type', 'trans_id', 'log_id'], 'required'],
            [['person_id', 'trans_id', 'log_id'], 'integer'],
//            [['visited_at'], 'safe'],
            [['auth_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Персона',
            'visited_at' => 'Дата',
            'auth_type' => 'Тип доступа',
            'trans_id' => 'Trans ID',
            'log_id' => 'Log ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return VisitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VisitQuery(get_called_class());
    }
public function type(){
        $types['FP']='Отпечаток пальца';
    $types['FACE']='3D-сканирование лица';
    $types['PWD']='Ввод пароля';
    $types['Tamper']='Электронный брелок';
    return $types[$this->auth_type];
}
    public function type_short(){
        $types['FP']='Палец';
        $types['FACE']='Лицо';
        $types['PWD']='Пароль';
        $types['Tamper']='Брелок';
        return $types[$this->auth_type];
    }

    public function getPerson(){
        return $this->hasOne(Person::className(),['id' => 'person_id']);
    }
}
