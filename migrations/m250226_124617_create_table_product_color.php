<?php

use yii\db\Migration;

class m250226_124617_create_table_product_color extends Migration
{
    public function up()
    {
        $this->createTable('product_color', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull()->comment('Продукт'),
            'color_id' => $this->integer()->notNull()->comment('Цвет')
        ]);

        $this->addForeignKey(
            'fk_product_color_product_id',
            'product_color',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk_product_color_color_id',
            'product_color',
            'color_id',
            'color',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_product_color_product_id', 'product_color');
        $this->dropForeignKey('fk_product_color_color_id', 'product_color');
        $this->dropTable('product_color');
    }
}
