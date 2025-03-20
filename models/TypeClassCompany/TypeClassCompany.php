<?php

namespace app\models\TypeClassCompany;

use yii\db\ActiveRecord;
use app\models\Company\CompanyTypeClassCompany;

class TypeClassCompany extends ActiveRecord
{
    public static function tableName()
    {
        return 'type_class_company';
    }

    public function rules()
    {
        return [
            [['type_company_id', 'name'], 'required'],
            [['type_company_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'unique',
                'targetClass' => TypeClassCompany::class, 'targetAttribute' => ['name', 'type_company_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_company_id' => 'Тип',
            'type_company' => 'Тип',
            'name' => 'Название',
        ];
    }

    public function getType_company()
    {
        return $this->hasOne(TypeCompany::class, ['id' => 'type_company_id']);
    }

    public function getCompany_type_class_company()
    {
        return $this->hasMany(CompanyTypeClassCompany::class, ['type_class_company_id' => 'id']);
    }

    public static function getListByTypeCompanyId($id)
    {
        return self::find()
            ->select(['name', 'id'])
            ->where(['type_company_id' => $id])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }
}