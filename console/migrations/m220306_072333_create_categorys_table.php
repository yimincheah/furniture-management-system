<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categorys}}`.
 */
class m220306_072333_create_categorys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categorys}}', [
            'category_id' => $this->primaryKey(),
            'category_name' => $this->string()->notNull()->unique(),
            'category_status' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categorys}}');
    }
}
