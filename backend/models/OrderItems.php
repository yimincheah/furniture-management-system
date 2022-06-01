<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int|null $product_id
 * @property float|null $price
 * @property int|null $quantity
 * @property float|null $total_price
 * @property int $created_at
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['price', 'total_price'], 'number'],
            [['created_at'], 'safe']
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' =>  \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT =>  ['created_at'],
                ],
                'value' => function() { return date('U');} // unix timestamp ,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'total_price' => 'Total Price',
            'created_at' => 'Created At',
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['product_id' => 'product_id']);
    }

}
