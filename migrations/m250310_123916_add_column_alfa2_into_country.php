<?php

use yii\db\Migration;

class m250310_123916_add_column_alfa2_into_country extends Migration
{
    public function up()
    {
        $this->addColumn('country', 'alfa2',
            $this->string(2)->null()->after('id'));
    }

    public function down()
    {
        $this->dropColumn('country', 'alfa2');
    }
}
