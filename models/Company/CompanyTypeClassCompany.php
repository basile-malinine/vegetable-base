<?php

namespace app\models\Company;

use app\models\InfoSource\InfoSource;
use app\models\TypeClassCompany\TypeClassCompany;
use app\models\TypeClassCompany\TypeCompany;
use yii\db\ActiveRecord;

class CompanyTypeClassCompany extends ActiveRecord
{
    public static function tableName()
    {
        return 'company_type_class_company';
    }

    public function rules()
    {
        return [
            [[
                'company_id',
                'type_company_id',
                'type_class_company_id',
                'info_source_id',
                'date_info',
            ], 'required'],

            [[
                'company_id',
                'type_company_id',
                'type_class_company_id',
                'info_source_id',
            ], 'integer'],

            [['date_info', 'date_actuality'], 'safe'],

            [['type_company_id'], 'unique', 'targetAttribute' => ['company_id', 'type_company_id', 'info_source_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Контрагент',
            'type_company_id' => 'Тип контрагента',
            'type_class_company_id' => 'Класс контрагента',
            'info_source_id' => 'Источник информации',
            'date_info' => 'Дата информации',
            'date_actuality' => 'Дата актуальности',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->date_info = date('Y-m-d', strtotime($this->date_info));

        if ($this->date_actuality) {
            CompanyTypeClassCompany::updateAll(['date_actuality' => null],
                ['like', 'type_company_id', $this->type_company_id]);
            $this->date_actuality = date('Y-m-d', strtotime($this->date_actuality));
        }

        return true;
    }

    public function afterFind()
    {
        if ($this->date_info) {
            $this->date_info = date('d.m.Y', strtotime($this->date_info));
        }
        if ($this->date_actuality) {
            $this->date_actuality = date('d.m.Y', strtotime($this->date_actuality));
        }
    }

    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    public function getType_company()
    {
        return $this->hasOne(TypeCompany::class, ['id' => 'type_company_id']);
    }

    public function getType_class_company()
    {
        return $this->hasOne(TypeClassCompany::class, ['id' => 'type_class_company_id']);
    }

    public function getInfo_source()
    {
        return $this->hasOne(InfoSource::class, ['id' => 'info_source_id']);
    }

    public static function getListByIds($ids): array
    {
        return self::find()
            ->select(['CONCAT(type_company.name, "::", type_class_company.name) as name',
                'company_type_class_company.id as id'])
            ->joinWith(['type_company', 'type_class_company'])
            ->where(['company_type_class_company.id' => $ids])
            ->andWhere('date_actuality')
            ->indexBy('company_type_class_company.id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    public static function notActualByCompanyId($id)
    {
        return (bool)self::find()
            ->where(['company_id' => $id])
            ->andWhere(['date_actuality' => null])
            ->count();
    }

    public static function newRecByCompanyId($id)
    {
        $typeIds = TypeCompany::find()
            ->select('id')
            ->column();

        foreach ($typeIds as $typeId) {
            $dateActual = CompanyTypeClassCompany::find()->select(['MAX(date_actuality)'])
                ->where(['company_id' => $id, 'type_company_id' => $typeId])->scalar();
            $newRecs = CompanyTypeClassCompany::find()->select('id')
                ->where(['company_id' => $id, 'type_company_id' => $typeId])
                ->andWhere('date_info > :dateActual', [':dateActual' => $dateActual])
                ->count();
            if ($newRecs > 0) {
                break;
            };
        }

        return $newRecs;
    }
}