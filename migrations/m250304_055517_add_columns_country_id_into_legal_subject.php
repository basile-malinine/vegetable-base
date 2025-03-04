<?php

use yii\db\Migration;

class m250304_055517_add_columns_country_id_into_legal_subject extends Migration
{
    public function up()
    {
        $this->dropIndex('inn', 'legal_subject');

        $this->addColumn('legal_subject', 'country_id',
            $this->integer()->notNull()->defaultValue(1)->after('id')->comment('Страна'));

        $this->addForeignKey(
            'fk_legal_subject_country_id',
            'legal_subject',
            'country_id',
            'country',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_legal_subject_country_id', 'legal_subject');
        $this->dropColumn('legal_subject', 'country_id');
        $this->createIndex('inn', 'legal_subject',
            'inn', unique: true );
    }
}
