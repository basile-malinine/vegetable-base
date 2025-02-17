<?php

namespace app\models\Company;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanyAliasSearch extends CompanyAlias
{
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
        $query = CompanyAlias::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);

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