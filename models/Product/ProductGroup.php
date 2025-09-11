<?php

namespace app\models\Product;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "product_group".
 *
 * @property int $id ID
 * @property string $name Название
 * @property string|null $comment Комментарий
 */
class ProductGroup extends ActiveRecord
{
    public static function tableName()
    {
        return 'product_group';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['comment'], 'string'],
            [['comment'], 'default', 'value' => null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название группы',
            'comment' => 'Комментарий',
        ];
    }
}
