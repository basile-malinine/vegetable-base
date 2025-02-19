<?php

namespace app\models\Company;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanyLegalSubjectSearch extends CompanyLegalSubject
{
    public $company;
    public $legal_subject;

    public function rules(): array
    {
        return [
            [['company, legal_subject'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CompanyLegalSubject::find()
            ->joinWith(['company', 'legal_subject']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['company'] = [
            'asc' => ['company.name' => SORT_ASC],
            'desc' => ['company.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['legal_subject'] = [
            'asc' => ['legal_subject.name' => SORT_ASC, 'company.name' => SORT_ASC],
            'desc' => ['legal_subject.name' => SORT_DESC, 'company.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'company.name', $this->company]);
        $query->andFilterWhere(['like', 'legal_subject.name', $this->legal_subject]);

        // Если выводим список для конкретного Контрагента
        if ($params['company_id'] ?? null) {
            $query->andFilterWhere(['company_id' => $params['company_id']]);
        }

        if (!isset($params['sort'])) {
            $query->orderBy('company.name ASC');
        }
        return $dataProvider;
    }
}