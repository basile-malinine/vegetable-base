<?php

use yii\db\Migration;

class m250317_020150_create_table_info_source extends Migration
{
    public function up()
    {
        $this->createTable('info_source', [
            'id' => $this->primaryKey(),
            'info_source_group_id' => $this->integer()->null()->comment('Группа'),
            'name' => $this->string(127)->notNull()->unique()->comment('Название'),
            'class' => $this->smallInteger()->defaultValue(1)->comment('Класс'),
            'rating' => $this->smallInteger()->defaultValue(1)->comment('Рейтинг'),
            'comment' => $this->text()->null()->comment('Комментарий'),
        ]);

        $this->createIndex(
            'idx_info_source_info_source_group_id',
            'info_source',
            'info_source_group_id'
        );

        $this->addForeignKey(
            'fk_info_source_info_source_group_id',
            'info_source',
            'info_source_group_id',
            'info_source_group',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('info_source');
    }
}
