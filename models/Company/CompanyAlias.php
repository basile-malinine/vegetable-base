<?php

namespace app\models\Company;

use Yii;

/**
 * This is the model class for table "company_alias".
 *
 * @property int $id
 * @property int $company_id Контрагент
 * @property string $name Псевдоним
 *
 * @property Company $company
 */
class CompanyAlias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_alias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'name'], 'required'],
            [['company_id'], 'integer'],
            [['name'], 'string', 'min' => 1, 'max' => 30],
            [['name'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Контрагент',
            'company' => 'Контрагент',
            'name' => 'Псевдоним',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    public static function getListByCompanyId($companyId)
    {
        $res = self::find()
            ->select('name, id')
            ->where(['company_id' => $companyId])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();

        return $res;
    }
}
