<?php

namespace app\models\Color;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UnitSearch represents the model behind the search form of `app\models\Unit\Unit`.
 */
class ColorSearch extends Color
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['value'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Color::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        if (!isset($params['sort'])) {
            $query->orderBy('value');
        }

        return $dataProvider;
    }
}
