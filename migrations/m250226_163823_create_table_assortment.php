<?php

use yii\db\Migration;

class m250226_163823_create_table_assortment extends Migration
{
    public function up()
    {
        $this->createTable('assortment', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()->comment('Название'),
            'product_id' => $this->integer()->notNull()->comment('Базовый продукт'),
            'color_id' => $this->integer()->null()->comment('Цвет'),
        ]);

        $this->addForeignKey(
            'fk_assortment_product_id',
            'assortment',
            'product_id',
            'product',
            'id',
            'NO ACTION',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk_assortment_color_id',
            'assortment',
            'color_id',
            'color',
            'id',
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_assortment_product_id', 'assortment');
        $this->dropForeignKey('fk_assortment_color_id', 'assortment');
        $this->dropTable('assortment');
    }
}
