<?php

use yii\db\Migration;

/**
 * Class m250211_043821_create_table_company
 */
class m250211_043821_create_table_company extends Migration
{
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->comment('Название'),
            'is_seller' => $this->boolean()->notNull()->defaultValue(0)->comment('Продавец'),
            'is_buyer' => $this->boolean()->notNull()->defaultValue(0)->comment('Покупатель'),
        ]);
    }

    public function down()
    {
        $this->dropTable('company');
    }
}
