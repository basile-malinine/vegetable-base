<?php

use yii\db\Migration;

class m250304_120513_add_columns_into_country extends Migration
{
    public function up()
    {
        $this->addColumn('country', 'inn_legal_name',
            $this->string(10)->notNull()->defaultValue('ИНН')->comment('Название ID для Юр. лица'));
        $this->addColumn('country', 'inn_legal_size',
            $this->smallInteger()->notNull()->defaultValue(10)->comment('Ширина ID для Юр. лица'));
        $this->addColumn('country', 'inn_name',
            $this->string(10)->notNull()->defaultValue('ИНН')->comment('Название ID для Физ. лица'));
        $this->addColumn('country', 'inn_size',
            $this->smallInteger()->notNull()->defaultValue(12)->comment('Ширина ID для Физ. лица'));
    }

    public function down()
    {
        $this->dropColumn('country', 'inn_size');
        $this->dropColumn('country', 'inn_name');
        $this->dropColumn('country', 'inn_legal_size');
        $this->dropColumn('country', 'inn_legal_name');
    }
}
