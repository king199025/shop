<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_product}}`.
 */
class m191023_073228_create_order_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_product}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'product_id' => $this->integer(11),
        ]);
        $this->addForeignKey('orderId', 'order_product','order_id', 'order', 'id');
        $this->addForeignKey('productId', 'order_product','product_id', 'products', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('orderId', 'order_product');
        $this->dropForeignKey('productId', 'order_product');
        $this->dropTable('{{%order_product}}');
    }
}
