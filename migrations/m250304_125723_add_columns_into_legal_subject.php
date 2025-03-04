<?php

use yii\db\Migration;

class m250304_125723_add_columns_into_legal_subject extends Migration
{
    public function up()
    {
        $this->addColumn('legal_subject', 'director',
            $this->string(30)->null()->defaultValue(null)->comment('Директор'));
        $this->addColumn('legal_subject', 'accountant',
            $this->string(30)->null()->defaultValue(null)->comment('Бухгалтер'));
        $this->addColumn('legal_subject', 'comment',
            $this->text()->null()->defaultValue(null)->comment('Комментарий'));
    }

    public function down()
    {
        $this->dropColumn('legal_subject', 'comment');
        $this->dropColumn('legal_subject', 'accountant');
        $this->dropColumn('legal_subject', 'director');
    }
}
