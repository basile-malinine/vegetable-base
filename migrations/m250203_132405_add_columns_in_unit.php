<?php

use yii\db\Migration;

/**
 * Class m250203_132405_add_columns_in_unit
 */
class m250203_132405_add_columns_in_unit extends Migration
{
    public function up()
    {
        $this->addColumn('unit', 'is_weight',
            $this->smallInteger()->defaultValue(0)->comment('Весовая'));
        $this->addColumn('unit', 'weight',
            $this->decimal(10, 3)->null()->comment('Вес'));
    }

    public function down()
    {
        $this->dropColumn('unit', 'weight');
        $this->dropColumn('unit', 'is_weight');
    }
}
