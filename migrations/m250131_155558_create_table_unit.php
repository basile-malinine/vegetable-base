<?php

use yii\db\Migration;

/**
 * Class m250131_155558_create_table_unit
 */
class m250131_155558_create_table_unit extends Migration
{
    public function up()
    {
        $this->createTable('unit', [
            'id' => $this->primaryKey(),
            'name' => $this->string(12)->notNull()->unique()->comment('Единица измерения'),
        ]);
    }

    public function down()
    {
        $this->dropTable('unit');
    }
}
