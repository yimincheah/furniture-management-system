<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customers}}`.
 */
class m220306_131238_create_customers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customers}}', [
            'customer_id' => $this->primaryKey(),
            'customer_name' => $this->string()->notNull(),
            'customer_status' => $this->string()->notNull(),
            'customer_email' => $this->string()->notNull(),
            'customer_contact' => $this->string()->notNull(),
            'customer_address' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customers}}');
    }
}
