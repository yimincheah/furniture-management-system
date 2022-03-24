<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m220323_034155_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->string()->notNull(),
            'country' => $this->string()->notNull(),
            'state' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'post_code' => $this->integer(),
            'address_line1' => $this->string()->notNull(),
            'address_line2' => $this->string()->notNull(),
            'customer_id' => $this->integer(),
            'staff_id' => $this->integer(),
            'delivery_date' => $this->date(),
            'order_status' => $this->integer(),
            'order_quantity' => $this->integer(),
            'total_price' => $this->decimal(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-orders-customer_id',
            'orders',
            'customer_id'
        );

        $this->createIndex(
            'idx-orders-staff_id',
            'orders',
            'staff_id'
        );

        $this->addForeignKey(
            'fk-orders-customer_id',
            'orders',
            'customer_id',
            'customers',
            'customer_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-orders-staff_id',
            'orders',
            'staff_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
