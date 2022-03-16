<?php

use yii\db\Migration;

/**
 * Class m220315_084141_add_ref_to_user_table
 */
class m220315_084141_add_ref_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'ref', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'ref');

        echo "m220315_084141_add_ref_to_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220315_084141_add_ref_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
