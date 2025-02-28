<?php

namespace app\models\Color;

use yii\db\ActiveRecord;

class Color extends ActiveRecord
{
    public static function tableName()
    {
        return 'color';
    }

    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'unique'],
            [['value'], 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Значение',
        ];
    }

    public static function getList()
    {
        $ret = self::find()
            ->select(['value', 'id'])
            ->indexBy('id')
            ->orderBy(['value' => SORT_ASC])
            ->column();

        return $ret;
    }

    public static function getListByIds($ids)
    {
        return self::find()
            ->select(['value', 'id'])
            ->where(['id' => $ids])
            ->indexBy('id')
            ->orderBy('value')
            ->column();
    }
}