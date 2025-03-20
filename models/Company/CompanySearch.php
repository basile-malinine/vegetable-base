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
            [['name', 'legal_subject', 'aliasOn'], 'safe'],
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

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Фильтры для GridView:
        // По Названию и Псевдонимам
        $query->andFilterWhere(['like', 'company.name', $this->name]);
        if ($this->aliasOn) {
            $query->orFilterWhere(['like', 'company_alias.name', $this->name]);
        }
        // По Доверенным лицам
        if ($this->legal_subject) {
            $ids = LegalSubject::find()
                ->select('id')
                ->filterWhere(['like', 'name', $this->legal_subject])
                ->column();
            $query->andWhere(['company_legal_subject.legal_subject_id' => $ids]);
        }

        if (!isset($params['sort'])) {
            $query->orderBy('name');
        }

        return $dataProvider;
    }
}
