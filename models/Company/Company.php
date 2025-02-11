<?php

namespace app\models\Company;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name Название
 * @property int $is_seller Продавец
 * @property int $is_buyer Покупатель
 */
class Company extends ActiveRecord
{
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
            [['is_seller', 'is_buyer'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'trim'],
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
            'is_seller' => 'Продавец',
            'is_buyer' => 'Покупатель',
        ];
    }
}
