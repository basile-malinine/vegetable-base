<?php

use yii\db\Migration;

class m250317_131742_create_table_type_class_company extends Migration
{
    public function up()
    {
        $this->createTable('type_class_company', [
            'id' => $this->primaryKey(),
            'type_company_id' => $this->integer()->notNull()->comment('Тип'),
            'name' => $this->string(30)->notNull()->comment('Название'),
        ]);

        $this->createIndex(
            'idx_type_class_company_type_company_id',
            'type_class_company',
            'type_company_id'
        );

        $this->addForeignKey(
            'fk_type_class_company_type_company_id',
            'type_class_company',
            'type_company_id',
            'type_company',
            'id',
            'CASCADE',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('type_class_company');
    }
}
