<?php

namespace app\models\Company;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanySearch extends Company
{
    public function rules(): array
    {
        return [
            [['name', 'is_seller', 'is_buyer'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Company::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'is_seller', $this->is_seller]);
        $query->andFilterWhere(['like', 'is_buyer', $this->is_buyer]);

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }
        return $dataProvider;
    }
}
