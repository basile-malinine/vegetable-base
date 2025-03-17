<?php

namespace app\models\TypeClassCompany;

use app\models\TypeClassCompany\TypeClassCompany;
use yii\data\ActiveDataProvider;

class TypeClassCompanySearch extends TypeClassCompany
{
    public $type_company;

    public function rules()
    {
        return [
            [['name', 'type_company'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = TypeClassCompany::find()
            ->joinWith('type_company');

        $dataProvider = new ActiveDataProvider(compact('query'));

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orderBy('name ASC');

        return $dataProvider;
    }
}