<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%customers}}`.
 */
class m220307_042522_drop_customer_address_column_from_customers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%customers}}', 'customer_address');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%customers}}', 'customer_address', $this->text());
    }
}
