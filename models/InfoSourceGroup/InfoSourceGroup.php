<?php

namespace app\models\InfoSourceGroup;

use yii\db\ActiveRecord;

class InfoSourceGroup extends ActiveRecord
{
    public static function tableName()
    {
        return 'info_source_group';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'min' => 1, 'max' => 30],
            [['comment'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'comment' => 'Комментарий',
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