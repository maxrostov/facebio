<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Doc;

/**
 * DocSearch represents the model behind the search form of `app\models\Doc`.
 */
class DocSearch extends Doc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'type_id', 'status_id', 'is_primary', 'is_helped'], 'integer'],
            [['issued_by', 'issued_date', 'serial', 'number', 'registration', 'info'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Doc::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'person_id' => $this->person_id,
            'type_id' => $this->type_id,
            'status_id' => $this->status_id,
            'is_primary' => $this->is_primary,
            'is_helped' => $this->is_helped,
            'issued_date' => $this->issued_date,
        ]);

        $query->andFilterWhere(['like', 'issued_by', $this->issued_by])
            ->andFilterWhere(['like', 'serial', $this->serial])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'registration', $this->registration])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
