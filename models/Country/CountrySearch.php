<?php

namespace app\models\Country;

use app\models\Country\Country;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CountrySearch extends Country
{
    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Country::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orderBy(['name' => SORT_ASC]);

        return $dataProvider;
    }
}