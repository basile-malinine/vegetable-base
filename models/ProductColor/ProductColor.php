<?php

namespace app\models\ProductColor;

use yii\db\ActiveRecord;
use app\models\Color\Color;
use app\models\Product\Product;

class ProductColor extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_color';
    }

    public function rules()
    {
        return [
            [['product_id', 'color_id'], 'required'],
            [['product_id', 'color_id'], 'integer'],
            [['color_id'], 'unique', 'targetAttribute' => ['product_id', 'color_id'],
                'message' => 'У Продукта этот Цвет уже в списке'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Продукт',
            'product' => 'Продукт',
            'color_id' => 'Цвет',
            'color' => 'Цвет',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getColor()
    {
        return $this->hasOne(Color::class, ['id' => 'color_id']);
    }
}