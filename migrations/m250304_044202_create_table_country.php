<?php

use yii\db\Migration;

class m250304_044202_create_table_country extends Migration
{
    public function up()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->unique()->comment('Название'),
        ]);

        $this->insert('country', ['name' => 'Россия']);
    }

    public function down()
    {
        $this->dropTable('country');
    }
}
