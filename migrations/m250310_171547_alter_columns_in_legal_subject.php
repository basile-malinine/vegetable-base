<?php

use yii\db\Migration;

class m250310_171547_alter_columns_in_legal_subject extends Migration
{
    public function up()
    {
        $this->alterColumn('legal_subject', 'director',
            $this->string(255)->null()->defaultValue(null)->comment('Директор'));
        $this->alterColumn('legal_subject', 'accountant',
            $this->string(255)->null()->defaultValue(null)->comment('Бухгалтер'));
    }

    public function down()
    {
        $this->alterColumn('legal_subject', 'director',
            $this->string(30)->null()->defaultValue(null)->comment('Директор'));
        $this->alterColumn('legal_subject', 'accountant',
            $this->string(30)->null()->defaultValue(null)->comment('Бухгалтер'));
    }
}
