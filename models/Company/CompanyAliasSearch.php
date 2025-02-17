<?php

namespace app\models\Company;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanyAliasSearch extends CompanyAlias
{
    public $company;

    public function rules(): array
    {
        return [
            [['name', 'company'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CompanyAlias::find()
            ->joinWith('company');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['company'] = [
            'asc' => ['company.name' => SORT_ASC],
            'desc' => ['company.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'company_alias.name', $this->name]);
        $query->andFilterWhere(['like', 'company.name', $this->company]);

        // Если выводим список для конкретного Контрагента
        if ($params['company_id'] ?? null) {
            $query->andFilterWhere(['company_id' => $params['company_id']]);
        }

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }
        return $dataProvider;
    }
}