<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m191023_070747_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'descr' => $this->text(),
            'price' => $this->integer(7),
            'photo' => $this->string(255),
            'weight' => $this->integer(7),
            'category_id' => $this->integer(11),
            'status' => $this->tinyInteger(1),
        ]);
        $this->addForeignKey('categoryId','products','category_id','category','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('categotyId', 'products');
        $this->dropTable('{{%products}}');
    }
}
