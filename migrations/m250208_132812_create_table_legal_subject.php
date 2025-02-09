<?php

use yii\db\Migration;

/**
 * Class m250208_132812_create_table_legal_subject
 */
class m250208_132812_create_table_legal_subject extends Migration
{
    public function up()
    {
        $this->createTable('legal_subject', [
            'id' => $this->primaryKey(),
            'is_legal' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Юридическое лицо'),
            'name' => $this->string(30)->notNull()->comment('Краткое название предприятия или ФИО'),
            'full_name' => $this->string(100)->notNull()->comment('Полное название предприятия или ФИО'),
            'inn' => $this->string(12)->null()->unique()->comment('ИНН'),
        ]);
    }

    public function down()
    {
        $this->dropTable('legal_subject');
    }
}
