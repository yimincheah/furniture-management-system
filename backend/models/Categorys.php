<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categorys".
 *
 * @property int $category_id
 * @property string $category_name
 * @property string $category_status
 * @property int $created_at
 * @property int $updated_at
 */
class Categorys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categorys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'category_status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_name', 'category_status'], 'string', 'max' => 255],
            [['category_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_status' => 'Category Status',
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

    public static function getCategoryStatusList()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ];
    }

    public static function getCategoryStatus($status)
    {
        $list = self::getCategoryStatusList();
        return $list[$status] ? $list[$status] : '';
    }
}
