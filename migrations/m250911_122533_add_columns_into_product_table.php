<?php

use yii\db\Migration;

class m250911_122533_add_columns_into_product_table extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'product_group_id',
            $this->integer()->notNull()->after('id')->comment('Группа классификатора'));

        $this->createIndex(
            '{{%idx-product-product_group_id}}',
            '{{%product}}',
            'product_group_id'
        );

        $this->addForeignKey(
            '{{%fk-product-product_group_id}}',
            '{{%product}}',
            'product_group_id',
            '{{%product_group}}',
            'id',
            'NO ACTION'
        );

        $this->addColumn('product', 'comment',
            $this->text()->null()->comment('Комментарий'));
    }

    public function down()
    {
        $this->dropColumn('product', 'comment');
        $this->dropForeignKey('{{%fk-product-product_group_id}}', '{{%product}}');
        $this->dropIndex('{{%idx-product-product_group_id}}', '{{%product}}');
        $this->dropColumn('product', 'product_group_id');
    }
}
