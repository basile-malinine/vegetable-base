<?php

use yii\db\Migration;

class m250320_153028_drop_columns_from_company extends Migration
{
    public function up()
    {
        $this->dropColumn('company', 'is_seller');
        $this->dropColumn('company', 'is_buyer');
    }

    public function down()
    {
        $this->addColumn('company', 'is_seller',
            $this->boolean()->notNull()->defaultValue(0)->comment('Продавец'));
        $this->addColumn('company', 'is_buyer',
            $this->boolean()->notNull()->defaultValue(0)->comment('Покупатель'));
    }
}
