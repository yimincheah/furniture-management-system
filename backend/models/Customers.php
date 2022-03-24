<?php

namespace backend\models;

use Yii;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * This is the model class for table "customers".
 *
 * @property int $customer_id
 * @property string $customer_name
 * @property string $customer_status
 * @property string $customer_email
 * @property string $customer_contact
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $country
 * @property string|null $state
 * @property string|null $city
 * @property string|null $postCode
 * @property string|null $addressLine1
 * @property string|null $addressLine2
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_name', 'customer_status', 'customer_contact', 'country', 'state', 'city', 'postCode', 'addressLine1'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_name', 'customer_status', 'customer_email', 'customer_contact', 'country', 'state', 'city', 'postCode', 'addressLine1', 'addressLine2'], 'string', 'max' => 255],
            [['customer_contact'], PhoneInputValidator::className()], 
            [['customer_email'], 'email'],
            [['customer_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'customer_status' => 'Status',
            'customer_email' => 'Email Address',
            'customer_contact' => 'Contact Number',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'postCode' => 'Post Code',
            'addressLine1' => 'Address Line 1',
            'addressLine2' => 'Address Line 2',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' =>  \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT =>  ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() { return date('U');} // unix timestamp ,
            ],
        ];
    }

    public static function getCustomerStatusList()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ];
    }

    public static function getCustomerStatus($status)
    {
        $list = self::getCustomerStatusList();
        return $list[$status] ? $list[$status] : '';
    }

    public function getStateName()
    {
        return $this->hasOne(States::className(), ['state_id' => 'state']);
    }

    public function getCityName()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city']);
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customer_id' => 'customer_id']);
    }
}
