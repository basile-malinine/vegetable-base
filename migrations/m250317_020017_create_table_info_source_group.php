<?php

use yii\db\Migration;

class m250317_020017_create_table_info_source_group extends Migration
{
    public function up()
    {
        $this->createTable('info_source_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->unique()->comment('Название'),
            'comment' => $this->text()->null()->comment('Комментарий'),
        ]);
    }

    public function down()
    {
        $this->dropTable('info_source_group');
    }
}
