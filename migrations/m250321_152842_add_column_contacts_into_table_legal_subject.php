<?php

use yii\db\Migration;

class m250321_152842_add_column_contacts_into_table_legal_subject extends Migration
{
    public function up()
    {
        $this->addColumn('legal_subject', 'contacts',
            $this->string(255)->notNull()->after('address')->comment('Контактная информация'));

    }

    public function down()
    {
        $this->dropColumn('legal_subject', 'contacts');
    }
}
