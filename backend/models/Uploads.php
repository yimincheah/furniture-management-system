<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $upload_id
 * @property string $file_name
 * @property string $real_filename
 * @property string $ref
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'real_filename', 'ref'], 'required'],
            [['file_name', 'real_filename', 'ref'], 'string', 'max' => 255],
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
        ];
    }
}
