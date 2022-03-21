<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220316_142206_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'product_id' => $this->primaryKey(),
            'product_name' => $this->string()->notNull(),
            'product_description' => $this->text()->notNull(),
            'product_price' => $this->double()->notNull(),
            'product_status' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'ref' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-products-category_id',
            'products',
            'category_id'
        );

        $this->createIndex(
            'idx-products-brand_id',
            'products',
            'brand_id'
        );

        $this->addForeignKey(
            'fk-products-category_id',
            'products',
            'category_id',
            'categorys',
            'category_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-brand_id',
            'products',
            'brand_id',
            'brands',
            'brand_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
