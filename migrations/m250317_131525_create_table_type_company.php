<?php

use yii\db\Migration;

class m250317_131525_create_table_type_company extends Migration
{
    public function up()
    {
        $this->createTable('type_company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->unique()->comment('Название'),
        ]);
    }

    public function down()
    {
        $this->dropTable('type_company');
    }
}
