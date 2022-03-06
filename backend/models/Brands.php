<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property int $brand_id
 * @property string $brand_name
 * @property string $brand_status
 * @property int $created_at
 * @property int $updated_at
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_name', 'brand_status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['brand_name', 'brand_status'], 'string', 'max' => 255],
            [['brand_name'], 'unique'],
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
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_status' => 'Brand Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getBrandStatusList()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ];
    }

    public static function getBrandStatus($status)
    {
        $list = self::getBrandStatusList();
        return $list[$status] ? $list[$status] : '';
    }
    
}
