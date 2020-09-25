<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%basket}}`.
 */
class m191028_094525_create_basket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%basket}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'product_id' => $this->integer(11),
        ]);
        $this->addForeignKey('fromProductId', 'basket','product_id', 'products', 'id');
        $this->addForeignKey('userIdB', 'basket','user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('productId', 'basket');
        $this->dropForeignKey('userIdB', 'basket');
        $this->dropTable('{{%basket}}');
    }
}
