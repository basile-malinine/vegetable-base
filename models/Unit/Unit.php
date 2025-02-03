<?php

namespace app\models\Unit;

use yii\db\ActiveRecord;

class Unit extends ActiveRecord
{
    public static function tableName()
    {
        return 'unit';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 12],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
        ];
    }
}