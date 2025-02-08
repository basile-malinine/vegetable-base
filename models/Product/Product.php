<?php

namespace app\models\Product;

use yii\db\ActiveRecord;
use app\models\Unit\Unit;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['name', 'unit_id'], 'required'],
            [['unit_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['weight'], 'number', 'numberPattern' => '/^\d+(.\d+)?$/'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'unit_id' => 'Ед. изм.',
            'weight' => 'Вес (кг)',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->weight = str_replace(',', '.', $this->weight);

        return true;
    }

    public function getUnit()
    {
        return $this->hasOne(Unit::class, ['id' => 'unit_id']);
    }
}