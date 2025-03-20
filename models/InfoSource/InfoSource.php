<?php

namespace app\models\InfoSource;

use app\models\Company\CompanyTypeClassCompany;
use yii\db\ActiveRecord;
use app\models\InfoSourceGroup\InfoSourceGroup;

class InfoSource extends ActiveRecord
{
    public static function tableName()
    {
        return 'info_source';
    }

    public function rules()
    {
        return [
            [['info_source_group_id', 'class', 'rating'], 'integer'],
            [['name', 'class', 'rating'], 'required'],
            [['name'], 'string', 'max' => 127],
            [['comment'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'info_source_group_id' => 'Группа',
            'group' => 'Группа',
            'name' => 'Название',
            'class' => 'Класс',
            'rating' => 'Рейтинг',
            'comment' => 'Комментарий',
        ];
    }

    public function getInfo_source_group()
    {
        return $this->hasOne(InfoSourceGroup::class, ['id' => 'info_source_group_id']);
    }

    public function getCompany_type_class_company()
    {
        return $this->hasMany(CompanyTypeClassCompany::class, ['info_source_id' => 'id']);
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