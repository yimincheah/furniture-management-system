<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%states}}`.
 */
class m220307_052525_create_states_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%states}}', [
            'state_id' => $this->primaryKey(),
            'state_name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%states}}');
    }
}
