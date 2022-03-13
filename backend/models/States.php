<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property int $state_id
 * @property string $state_name
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_name'], 'required'],
            [['state_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'state_id' => 'State ID',
            'state_name' => 'State Name',
        ];
    }

    public static function getStateList()
    { 
        return \yii\helpers\ArrayHelper::map(self::find()->select('state_id, state_name')->asArray()->all(), 'state_id', 'state_name');
    }

    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['state' => 'state_id']);
    }

    public function getCities()
    {
        return $this->hasMany(City::className(), ['state_id' => 'state_id']);
    }
}
