<?php

use yii\db\Migration;

/**
 * Class m250202_143841_create_table_product
 */
class m250202_143841_create_table_product extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'unit_id' => $this->integer(),
            'name' => $this->string(100)->notNull()->unique()->comment('Наименование'),
            'weight' => $this->decimal(10, 3)->comment('Вес (кг)'),
        ]);

        $this->createIndex(
            'idx_product_unit_id',
            'product',
            'unit_id'
        );

        $this->addForeignKey(
            'fk_product_unit_id',
            'product',
            'unit_id',
            'unit',
            'id',
            'NO ACTION', 'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_product_unit_id',
            'product'
        );

        $this->dropIndex(
            'idx_product_unit_id',
            'product'
        );

        $this->dropTable('product');
    }
}
