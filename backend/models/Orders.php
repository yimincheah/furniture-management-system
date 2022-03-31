<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $order_id
 * @property string $country
 * @property int|null $state
 * @property int|null $city
 * @property int|null $post_code
 * @property string $address_line1
 * @property string $address_line2
 * @property int|null $customer_id
 * @property int|null $staff_id
 * @property string|null $delivery_date
 * @property int|null $order_status
 * @property int|null $order_quantity
 * @property float|null $total_price
 * @property int $created_at
 *
 * @property Customers $customer
 * @property User $staff
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'country', 'address_line1'], 'required'],
            [['post_code', 'customer_id', 'staff_id', 'order_status', 'order_quantity'], 'integer'],
            [['delivery_date','created_at'], 'safe'],
            [['total_price'], 'number'],
            [['order_id', 'country', 'address_line1', 'address_line2', 'state', 'city'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'customer_id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['staff_id' => 'id']],
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
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'post_code' => 'Post Code',
            'address_line1' => 'Address Line 1',
            'address_line2' => 'Address Line 2',
            'customer_id' => 'Customer ID',
            'staff_id' => 'Staff ID',
            'delivery_date' => 'Delivery Date',
            'order_status' => 'Order Status',
            'order_quantity' => 'Order Quantity',
            'total_price' => 'Total Price',
            'created_at' => 'Created At',
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
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(User::className(), ['id' => 'staff_id']);
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    public static function getOrderStatusList()
    {
        return [
            '0' => 'Processing',
            '1' => 'Delivered',
            '2' => 'Cancelled',
        ];
    }
 
    public static function getOrderStatus($status)
    {
        $list = self::getOrderStatusList();
        return $list[$status] ? $list[$status] : '';
    }
}
