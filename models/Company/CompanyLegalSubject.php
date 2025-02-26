<?php

namespace app\models\Company;

use app\models\LegalSubject\LegalSubject;
use yii\db\ActiveRecord;

class CompanyLegalSubject extends ActiveRecord
{
    public static function tableName()
    {
        return 'company_legal_subject';
    }

    public function rules()
    {
        return [
            [['company_id', 'legal_subject_id'], 'required'],
            [['company_id', 'legal_subject_id'], 'integer'],
            [['legal_subject_id'], 'unique', 'targetAttribute' => ['company_id', 'legal_subject_id'],
                'message' => 'У Контрагента это Доверенное лицо уже в списке'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Контрагент',
            'company' => 'Контрагент',
            'legal_subject_id' => 'Доверенное лицо',
            'legal_subject' => 'Доверенное лицо',
        ];
    }

    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    public function getLegal_subject()
    {
        return $this->hasOne(LegalSubject::class, ['id' => 'legal_subject_id']);
    }
}
