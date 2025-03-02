<?php

namespace app\models\Product;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\models\Color\Color;
use app\models\ProductColor\ProductColor;
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
        ];
    }

    public function getProduct_color()
    {
        return $this->hasMany(ProductColor::class, ['product_id' => 'id']);
    }

    public static function getList()
    {
        return self::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->orderBy(['name' => SORT_ASC])
            ->column();
    }

    public static function getColorListByProductId($id)
    {
        $model = self::findOne(['id' => $id]);
        if (isset($model->product_color)) {
            $colorIds = ArrayHelper::getColumn($model->product_color, 'color_id');
        } else {
            $colorIds = null;
        }

        return Color::getListByIds($colorIds);
    }
}