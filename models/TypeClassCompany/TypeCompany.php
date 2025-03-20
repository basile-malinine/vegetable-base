<?php

namespace app\models\TypeClassCompany;

use yii\db\ActiveRecord;
use app\models\Company\CompanyTypeClassCompany;

class TypeCompany extends ActiveRecord
{
    public static function tableName()
    {
        return 'type_company';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    public function getType_class_company()
    {
        return $this->hasMany(TypeClassCompany::class, ['type_company_id' => 'id']);
    }

    public function getCompany_type_class_company()
    {
        return $this->hasMany(CompanyTypeClassCompany::class, ['type_company_id' => 'id']);
    }

    public static function getList()
    {
        return self::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }
}