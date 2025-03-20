<?php

use yii\db\Migration;

class m250319_142649_create_table_company_type_class_company extends Migration
{
    public function up()
    {
        $this->createTable('company_type_class_company', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull()->comment('Контрагент'),
            'type_company_id' => $this->integer()->notNull()->comment('Тип контрагента'),
            'type_class_company_id' => $this->integer()->notNull()->comment('Класс контрагента'),
            'info_source_id' => $this->integer()->notNull()->comment('Источник информации'),
            'date_info' => $this->date()->notNull()->comment('Дата информации'),
            'date_actuality' => $this->date()->null()->comment('Дата актуальности'),
        ]);

        $this->createIndex(
            'idx_company_type_class_company_company_id',
            'company_type_class_company',
            'company_id'
        );

        $this->addForeignKey(
            'fk_company_type_class_company_company_id',
            'company_type_class_company',
            'company_id',
            'company',
            'id',
            'NO ACTION',
            'NO ACTION'
        );

        $this->createIndex(
            'idx_company_type_class_company-type_company_id',
            'company_type_class_company',
            'type_company_id'
        );

        $this->addForeignKey(
            'fk_company_type_class_company_type_company_id',
            'company_type_class_company',
            'type_company_id',
            'type_company',
            'id',
            'NO ACTION',
            'NO ACTION'
        );

        $this->createIndex(
            'idx_company_type_class_company-type_class_company_id',
            'company_type_class_company',
            'type_class_company_id'
        );

        $this->addForeignKey(
            'fk_company_type_class_company_type_class_company_id',
            'company_type_class_company',
            'type_class_company_id',
            'type_class_company',
            'id',
            'NO ACTION',
            'NO ACTION'
        );

        $this->createIndex(
            'idx_company_type_class_company_info_source_id',
            'company_type_class_company',
            'info_source_id'
        );

        $this->addForeignKey(
            'fk_company_type_class_company_info_source_id',
            'company_type_class_company',
            'info_source_id',
            'info_source',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('company_type_class_company');
    }
}
