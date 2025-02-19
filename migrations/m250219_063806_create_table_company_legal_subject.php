<?php

use yii\db\Migration;

class m250219_063806_create_table_company_legal_subject extends Migration
{
    public function up()
    {
        $this->createTable('company_legal_subject', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull()->comment('Контрагент'),
            'legal_subject_id' => $this->integer()->notNull()->comment('Доверенное лицо'),
        ]);

        $this->addForeignKey(
            'fk_company',
            'company_legal_subject',
            'company_id',
            'company',
            'id', 'CASCADE',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk_legal_subject',
            'company_legal_subject',
            'legal_subject_id',
            'legal_subject',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('company_legal_subject');
    }
}
