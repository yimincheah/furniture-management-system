<?php

use yii\db\Migration;

/**
 * Class m220307_042656_add_address_to_customers_table
 */
class m220307_042656_add_address_to_customers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('customers', 'country', $this->string());
        $this->addColumn('customers', 'state', $this->integer());
        $this->addColumn('customers', 'city', $this->string());
        $this->addColumn('customers', 'postCode', $this->integer());
        $this->addColumn('customers', 'addressLine1', $this->string());
        $this->addColumn('customers', 'addressLine2', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('customers', 'country');
        $this->dropColumn('customers', 'state');
        $this->dropColumn('customers', 'city');
        $this->dropColumn('customers', 'postCode');
        $this->dropColumn('customers', 'addressLine1');
        $this->dropColumn('customers', 'addressLine2');

        echo "m220307_042656_add_address_to_customers_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220307_042656_add_address_to_customers_table cannot be reverted.\n";

        return false;
    }
    */
}
