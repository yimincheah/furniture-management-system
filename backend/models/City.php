<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $city_id
 * @property int|null $state_id
 * @property string $city_name
 *
 * @property States $state
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state_id'], 'integer'],
            [['city_name'], 'required'],
            [['city_name'], 'string', 'max' => 255],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state_id' => 'state_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'state_id' => 'State ID',
            'city_name' => 'City Name',
        ];
    }

    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(States::className(), ['state_id' => 'state_id']);
    }

    public static function getCityList()
    { 
        return \yii\helpers\ArrayHelper::map(self::find()->select('city_id, city_name')->asArray()->all(), 'city_id', 'city_name');
    }
}
