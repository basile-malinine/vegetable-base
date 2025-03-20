<?php

namespace app\models\Company;

use app\models\Company\CompanyTypeClassCompany;
use yii\data\ActiveDataProvider;

class CompanyTypeClassCompanySearch extends CompanyTypeClassCompany
{
    public function rules()
    {
        return [
            [['company_id', 'type_company_id', 'type_class_company_id', 'info_source_id'], 'integer'],
            [['date_info', 'date_actuality'], 'date', 'format' => 'dd.MM.yyyy'],
        ];
    }

    public function search($params)
    {
        $query = CompanyTypeClassCompany::find()
            ->select(
                [
                    'company_type_class_company.*',
                    'company.name as name_company',
                    'type_company.name as name_type',
                    'type_class_company.name as name_class',
                    'info_source.name as name_source',
                ]
            )
            ->distinct()
            ->joinWith(['company', 'type_company', 'type_class_company', 'info_source']);

        $dataProvider = new ActiveDataProvider(compact('query'));

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Если выводим список для конкретного Контрагента
        if ($params['company_id'] ?? null) {
            $query->andFilterWhere(['company_id' => $params['company_id']]);
        }

        if (!isset($params['sort'])) {
            $query->orderBy([
                'name_company' => SORT_ASC,
                'name_type' => SORT_ASC,
                'name_class' => SORT_ASC,
                'name_source' => SORT_ASC,
                'date_info' => SORT_DESC,
            ]);
        }

        return $dataProvider;
    }
}