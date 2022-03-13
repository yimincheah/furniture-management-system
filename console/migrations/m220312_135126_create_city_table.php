<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m220312_135126_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'city_id' => $this->primaryKey(),
            'state_id' => $this->integer(),
            'city_name' => $this->string()->notNull(),
        ]);

         $this->createIndex(
            'idx-city-state_id',
            'city',
            'state_id'
        );

        $this->addForeignKey(
            'fk-city-state_id',
            'city',
            'state_id',
            'states',
            'state_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
