<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%uploads}}`.
 */
class m220315_083732_create_uploads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%uploads}}', [
            'upload_id' => $this->primaryKey(),
            'file_name' => $this->string()->notNull(),
            'real_filename' => $this->string()->notNull(),
            'ref' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%uploads}}');
    }
}
