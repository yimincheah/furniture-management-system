<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "uploads_product".
 *
 * @property int $upload_id
 * @property string $file_name
 * @property string $real_filename
 * @property string $ref
 * @property int $created_at
 * @property int $updated_at
 */
class UploadsProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'real_filename', 'ref'], 'required'],
            [['created_at'], 'safe'],
            [['file_name', 'real_filename', 'ref'], 'string', 'max' => 255],
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
                'value' => function() { return date('U');} 
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'file_name' => 'File Name',
            'real_filename' => 'Real Filename',
            'ref' => 'Ref',
            'created_at' => 'Created At',
        ];
    }
}
