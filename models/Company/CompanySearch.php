<?php

namespace app\models\Company;

use app\models\LegalSubject\LegalSubject;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CompanySearch extends Company
{
    public $aliasOn;
    public $legal_subject;

    public function rules(): array
    {
        return [
            [['name', 'legal_subject', 'aliasOn', 'is_seller', 'is_buyer'], 'safe'],
        ];
    }

    public function scenarios(): array
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Company::find()
            ->distinct()
            ->joinWith(['company_alias', 'company_legal_subject']);

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

        // Фильтры для GridView:
        // По Названию и Псевдонимам
        $query->andFilterWhere(['like', 'company.name', $this->name]);
        if ($this->aliasOn) {
            $query->orFilterWhere(['like', 'company_alias.name', $this->name]);
        }
        // По Доверенным лицам
        $ids = LegalSubject::find()
            ->select('id')
            ->filterWhere(['like', 'name', $this->legal_subject])
            ->column();
        $query->andFilterWhere(['company_legal_subject.legal_subject_id' => $ids]);
        $query->andFilterWhere(['like', 'is_seller', $this->is_seller]);
        $query->andFilterWhere(['like', 'is_buyer', $this->is_buyer]);

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }
        return $dataProvider;
    }
}
