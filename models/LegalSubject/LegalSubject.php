<?php

namespace app\models\LegalSubject;

use app\models\Company\CompanyLegalSubject;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class LegalSubject extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'legal_subject';
    }

    public function rules(): array
    {
        return [
            [['name', 'full_name', 'is_legal'], 'required'],
            [['name'], 'string', 'min' => 1, 'max' => 30],
            [['full_name'], 'string', 'min' => 1, 'max' => 100],
            [['inn'], 'string', 'min' => 10, 'max' => 12],
            [['inn'], 'unique'],
            [['is_legal'], 'boolean'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'is_legal' => 'Юридическое лицо',
            'name' => 'Название или ФИО',
            'full_name' => 'Полное название или ФИО',
            'inn' => 'ИНН',
        ];
    }

    public function getCompany_legal_subject()
    {
        return $this->hasMany(CompanyLegalSubject::class, ['legal_subject_id' => 'id']);
    }

    public static function getList(): array
    {
        return self::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    public static function getListByIds($ids): array
    {
        return self::find()
            ->select(['name', 'id'])
            ->where(['company_id' => $ids])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    public static function getListExceptIds($ids): array
    {
        return self::find()
            ->select(['name', 'id'])
            ->where('id NOT IN(:ids)',  [':ids' => implode(',', $ids)])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }
}