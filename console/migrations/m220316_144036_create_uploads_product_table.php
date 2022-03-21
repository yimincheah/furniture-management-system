<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%uploads_product}}`.
 */
class m220316_144036_create_uploads_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%uploads_product}}', [
            'upload_id' => $this->primaryKey(),
            'file_name' => $this->string()->notNull(),
            'real_filename' => $this->string()->notNull(),
            'ref' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%uploads_product}}');
    }
}
