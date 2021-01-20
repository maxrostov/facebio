<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc".
 *
 * @property int $id
 * @property int $person_id
 * @property int $type_id Тип
 * @property int $status_id Статус документа
 * @property int $is_primary Основной
 * @property int $is_helped Выдан при содействии учреждения
 * @property string $issued_by Документ выдан
 * @property string $issued_date Дата выдачи
 * @property string $serial Серия
 * @property string $number Номер
 * @property string $registration Регистрация
 * @property string $info Примечание
 *
 * @property Person $person
 */
class Doc extends MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $upload,$del_doc_scan;

       public $types = [
           0 => 'Паспорт',
           1 => 'Военный билет',
           2 => 'Свидетельство о рождении',
           4 => 'Справка об освобождении',
           5 => 'Справка учащегося',
           6 => 'Временное удостоверение личности',
           7 => 'Свидетельство о временной регистрации',
           8 => 'Справка МСЭ об инвалидности',
           9 => 'Полис ОМС',
           10 => 'СНИЛС',
           11 => 'Прочее',
      ];

    public $statuses = [
        0 => 'Действующий',
        1 => 'Просрочен',
        2 => 'Утрачен',
     ];

    public  function type()
    {
//        $id = (!$this->type_id) ? 0 : $this->type_id;
        return $this->types[$this->type_id];
    }

    public  function status()
    {
        return $this->statuses[$this->status_id];
    }

    public static function tableName()
    {
        return 'doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'type_id', 'status_id', ], 'required'],
            [['person_id', 'type_id', 'status_id', 'is_primary', 'is_helped','del_doc_scan'], 'integer'],
            [['issued_date', 'is_primary', 'is_helped', 'issued_by', 'issued_date', 'serial', 'number', 'registration', 'info'], 'safe'],
            [['issued_by', 'serial', 'number', 'registration', 'info'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
            [['upload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],

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
            'type_id' => 'Тип',
            'status_id' => 'Статус документа',
            'is_primary' => 'Основной',
            'is_helped' => 'Выдан при содействии учреждения',
            'issued_by' => 'Документ выдан',
            'issued_date' => 'Дата выдачи',
            'serial' => 'Серия',
            'number' => 'Номер',
            'registration' => 'Регистрация',
            'info' => 'Примечание',
            'doc_scan' => 'Скан документа',
            'upload' => 'Скан документа',
            'del_doc_scan' => 'Удалить скан'
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * {@inheritdoc}
     * @return DocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocQuery(get_called_class());
    }
}
