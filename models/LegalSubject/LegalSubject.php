<?php

namespace app\models\LegalSubject;

use app\models\Company\CompanyLegalSubject;
use app\models\Country\Country;
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
            [['country_id'], 'integer'],
            [['inn'], 'unique', 'targetAttribute' => ['inn' , 'country_id'],
                'message' => 'Комбинация {attribute} и Страна уже существует'],
            [['is_legal'], 'boolean'],
            [['director'], 'string', 'max' => 255],
            [['accountant'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 255],
            [['contacts'],'string'],
            [['comment'], 'string'],
            [['inn'], 'checkInnForCountry'],
        ];
    }

    public function checkInnForCountry($attribute, $param): void
    {
        $innName = $this->is_legal ? $this->country->inn_legal_name : $this->country->inn_name;
        $innSize = $this->is_legal ? $this->country->inn_legal_size : $this->country->inn_size;
        if (mb_strlen($this->inn) !== $innSize) {
            $this->addError('inn', 'Размер поля ' . $innName . ' ' . $innSize . ' знаков!');
        }
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'country_id' => 'Страна',
            'country' => 'Страна',
            'is_legal' => 'Юридическое лицо',
            'name' => 'Название или ФИО',
            'full_name' => 'Полное название или ФИО',
            'inn' => 'ИНН',
            'director' => 'Директор',
            'accountant' => 'Бухгалтер',
            'address' => 'Адрес',
            'contacts' => 'Контактная информация',
            'comment' => 'Комментарий',
        ];
    }

    public function getCompany_legal_subject()
    {
        return $this->hasMany(CompanyLegalSubject::class, ['legal_subject_id' => 'id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
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
            ->where(['id' => $ids])
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