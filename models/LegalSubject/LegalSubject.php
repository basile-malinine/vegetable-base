<?php

namespace app\models\LegalSubject;

use yii\db\ActiveRecord;

class LegalSubject extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'legal_subject';
    }

    public function rules(): array
    {
        return [
            [['name', 'full_name', 'is_legal'], 'required'],
            [['name'], 'string', 'min' => 1, 'max' => 30],
            [['full_name'], 'string', 'min' => 1, 'max' => 100],
            [['inn'], 'string', 'min' => 10, 'max' => 12],
            [['is_legal'], 'boolean'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'is_legal' => 'Юридическое лицо',
            'name' => 'Название или ФИО',
            'full_name' => 'Полное название или ФИО',
            'inn' => 'ИНН',
        ];
    }
}