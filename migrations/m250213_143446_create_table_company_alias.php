<?php

use yii\db\Migration;

/**
 * Class m250213_143446_create_table_company_alias
 */
class m250213_143446_create_table_company_alias extends Migration
{
    public function up()
    {
        $this->createTable('company_alias', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull()->comment('Контрагент'),
            'name' => $this->string(30)->notNull()->unique()->comment('Псевдоним'),
        ]);

        $this->addForeignKey(
            'fk_company_alias_company_id',
            'company_alias',
            'company_id',
            'company',
            'id',
            'CASCADE',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_company_alias_company_id', 'company_alias');
        $this->dropTable('company_alias');
    }
}
