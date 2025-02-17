<?php

namespace app\models\Company;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name Название
 * @property string $aliases Псевдонимы
 * @property int $is_seller Продавец
 * @property int $is_buyer Покупатель
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
            [['is_seller', 'is_buyer'], 'integer'],
            [['aliases', 'legalSubjects'], 'safe'],
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
            'is_seller' => 'Продавец',
            'is_buyer' => 'Покупатель',
        ];
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
