<?php

namespace backend\models;

use Yii;
use yii\helpers\Url;
use backend\models\UploadsProduct;
/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property string $product_name
 * @property string $product_description
 * @property float $product_price
 * @property string $product_status
 * @property int $category_id
 * @property int $brand_id
 * @property string $ref
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Brands $brand
 * @property Categorys $category
 */
class Products extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER='products';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'product_description', 'product_price', 'product_status', 'category_id', 'brand_id', 'ref'], 'required'],
            [['product_price'], 'number'],
            [['category_id', 'brand_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_name', 'product_status', 'ref'], 'string', 'max' => 255],
            [['ref'], 'unique'],
            [['product_description'], 'string'],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categorys::className(), 'targetAttribute' => ['category_id' => 'category_id']],
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
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'product_description' => 'Product Description',
            'product_price' => 'Product Price',
            'product_status' => 'Product Status',
            'category_id' => 'Category',
            'brand_id' => 'Brand',
            'ref' => 'Ref',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categorys::className(), ['category_id' => 'category_id']);
    }

    public function getUploadsProduct()
    {
        return $this->hasMany(UploadsProduct::className(), ['ref' => 'ref']);
    }


    public static function getUploadPath()
    {
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl()
    {
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function getThumbnails($ref,$event_name)
    {
        $uploadFiles   = UploadsProduct::find()->where(['ref'=>$ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
   }

   public static function getProductStatusList()
   {
       return [
           '1' => 'Active',
           '0' => 'Inactive',
       ];
   }

   public static function getProductStatus($status)
   {
       $list = self::getProductStatusList();
       return $list[$status] ? $list[$status] : '';
   }

   public function initialPreviewConfig($ref)
   {
        $datas = UploadsProduct::find()->where(['ref'=>$ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption'=> $value->file_name,
                'width'  => '120px',
                'url'    => Url::to('index/php?r=products/deletefile-ajax'),
                'key'    => $value->upload_id,
            ]);
        }
        return  [$initialPreview,$initialPreviewConfig];


    }
    

}
