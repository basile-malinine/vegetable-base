<?php

use yii\db\Migration;

class m250314_201358_add_column_address_into_table_legal_subject extends Migration
{
    public function up()
    {
        $this->addColumn('legal_subject', 'address',
            $this->string(255)->null()->after('accountant')->comment('Адрес'));
    }

    public function down()
    {
        $this->dropColumn('legal_subject', 'address');
    }
}
