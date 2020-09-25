<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m191023_072232_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'dt_add' => $this->integer(11),
            'status' => $this->integer(1),
        ]);
        $this->addForeignKey('userId','order','user_id','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('userId','order');
        $this->dropTable('{{%order}}');
    }
}
