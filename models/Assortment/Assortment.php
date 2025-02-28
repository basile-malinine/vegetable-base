<?php

namespace app\models\Assortment;

use app\models\Color\Color;
use app\models\Product\Product;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "assortment".
 *
 * @property int $id
 * @property string $name Название
 * @property int $product_id Базовый продукт
 * @property int $color_id Цвет
 */
class Assortment extends ActiveRecord
{
    public static function tableName()
    {
        return 'assortment';
    }

    public function rules()
    {
        return [
            [['name', 'product_id'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['product_id', 'color_id'], 'integer'],
            [['name'], 'unique'],
            [['product_id', 'color_id'], 'unique',
                'targetAttribute' => ['product_id', 'color_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'product_id' => 'Базовый продукт',
            'product' => 'Базовый продукт',
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