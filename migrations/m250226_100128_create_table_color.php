<?php

use yii\db\Migration;

class m250226_100128_create_table_color extends Migration
{
    public function up()
    {
        $this->createTable('color', [
            'id' => $this->primaryKey(),
            'value' => $this->string(30)->notNull()->unique()->comment('Значение'),
        ]);
    }

    public function down()
    {
        $this->dropTable('color');
    }
}
