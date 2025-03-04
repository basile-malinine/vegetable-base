<?php

namespace app\models\Country;

use app\models\LegalSubject\LegalSubject;
use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    public static function tableName()
    {
        return 'country';
    }

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 30],
            [['name'], 'trim'],
            [['name'], 'unique'],
            [['inn_name', 'inn_legal_name'], 'string', 'max' => 10],
            [['inn_name', 'inn_legal_name'], 'trim'],
            [['inn_size', 'inn_legal_size'], 'integer'],
            [
                [
                    'name',
                    'inn_name', 'inn_legal_name',
                    'inn_size', 'inn_legal_size',
                ], 'required'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'inn_legal_name' => 'Название ID Юр. лица',
            'inn_legal_size' => 'Размер ID Юр. лица',
            'inn_name' => 'Название ID Физ. лица',
            'inn_size' => 'Размер ID Физ. лица',
        ];
    }

    public function getLegal_subject()
    {
        return $this->hasMany(LegalSubject::class, ['country_id' => 'id']);
    }

    public static function getList(): array
    {
        return self::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }
}