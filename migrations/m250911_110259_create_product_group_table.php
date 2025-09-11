<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_group}}`.
 */
class m250911_110259_create_product_group_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product_group}}', [
            'id' => $this->primaryKey()->comment('ID'),
            'name' => $this->string(100)->notNull()->unique()->comment('Название группы'),
            'comment' => $this->text()->null()->comment('Комментарий'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_group}}');
    }
}
