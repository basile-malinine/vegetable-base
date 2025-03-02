<?php

use app\models\Product\Product;
use yii\db\Migration;

class m250302_141527_drop_columns_from_product extends Migration
{
    public function up()
    {
        $this->dropForeignKey(
            'fk_product_unit_id',
            'product'
        );

        $this->dropIndex(
            'idx_product_unit_id',
            'product'
        );

        $this->dropColumn('product', 'unit_id');

        $this->dropColumn('product', 'weight');
    }

    public function down()
    {
        $this->addColumn('product', 'unit_id', $this->integer()->notNull()->after('id'));
        $this->addColumn('product', 'weight', $this->decimal(10, 3)->notNull()->after('name'));

        $products = Product::find()->all();
        foreach ($products as $product) {
            $product->unit_id = 1;
            $product->weight = 1.0;
            $product->save();
        }

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
}
