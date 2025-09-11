<?php

namespace app\models\Company;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name Название
 * @property string $aliases Псевдонимы
 */
class Company extends ActiveRecord
{
    public $aliases;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'trim'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'aliases' => 'Псевдонимы',
        ];
    }

    public function getCompany_alias()
    {
        return $this->hasMany(CompanyAlias::class, ['company_id' => 'id']);
    }

    public function getCompany_legal_subject()
    {
        return $this->hasMany(CompanyLegalSubject::class, ['company_id' => 'id']);
    }

    public function getCompany_type_class_company()
    {
        return $this->hasMany(CompanyTypeClassCompany::class, ['company_id' => 'id']);
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
