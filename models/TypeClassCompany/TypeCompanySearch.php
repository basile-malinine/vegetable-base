<?php

namespace app\models\TypeClassCompany;

use yii\data\ActiveDataProvider;

class TypeCompanySearch extends TypeCompany
{
    public $type_class_company;

    public function rules()
    {
        return [
            [['name', 'type_class_company'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = TypeCompany::find()
            ->joinWith('type_class_company');

        $dataProvider = new ActiveDataProvider(compact('query'));

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orderBy('name ASC');

        return $dataProvider;
    }
}