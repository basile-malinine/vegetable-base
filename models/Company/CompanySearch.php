<?php

namespace app\models\Company;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanySearch extends Company
{
    public $aliasOn;

    public function rules(): array
    {
        return [
            [['name', 'is_seller', 'is_buyer', 'aliasOn'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Company::find();
        $query->joinWith(['company_alias']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['is_seller'] = [
            'asc' => ['is_seller' => SORT_ASC, 'name' => SORT_ASC],
            'desc' => ['is_seller' => SORT_DESC, 'name' => SORT_ASC],
        ];
        $dataProvider->sort->attributes['is_buyer'] = [
            'asc' => ['is_buyer' => SORT_ASC, 'name' => SORT_ASC],
            'desc' => ['is_buyer' => SORT_DESC, 'name' => SORT_ASC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'company.name', $this->name]);
        if ($this->aliasOn) {
            $query->orFilterWhere(['like', 'company_alias.name', $this->name]);
        }
        $query->andFilterWhere(['like', 'is_seller', $this->is_seller]);
        $query->andFilterWhere(['like', 'is_buyer', $this->is_buyer]);

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }
        return $dataProvider;
    }
}
