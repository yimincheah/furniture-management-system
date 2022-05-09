<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Brands;
use backend\models\Categorys;
use backend\models\Orders;
use backend\models\UploadsProduct;

$this->title = 'Order Details';

\yii\web\YiiAsset::register($this);
?>
<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Order</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Order', ['/orders/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">
   <div class="container-fluid">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="pull-right">
            <?= Html::a('<i class="fa fa-print"></i> Print Invoice', ['print-invoice', 'id' => $model->id], ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->id], ['class'=>'btn','style' => 'background-color:black']) ?>  
        </div>
        <br> <br>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'order_id',
                'customer.customer_name',
                [
                    'attribute' =>'address',
                    'value' => $model->address_line1.", ".$model->address_line2.", ".$model->state.", ".$model->city.", ".$model->post_code." ,".$model->country
                ],
                'delivery_date:date',
                [
                    'label' => 'Assigned To',
                    'attribute' =>'staff_id',
                    'value' => 'staff.username'
                ],
                [
                    'attribute' => 'order_status',
                    'value' => function ($model) {
                        return Orders::getOrderStatus($model['order_status']);
                    },
                ],
                'order_quantity',
                [
                    'attribute' => 'total_price',
                    'format' => 'currency',
                ],
                'created_at:datetime',
            ],
        ]) ?>

        <div id="cart" class="cart_section">
            <div class="row">
                <div class="table-custom-responsive wow fadeInDown animated">
                    <table class="table-custom table-cart table-responsive">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                
                            </tr>
                        </thead>
                            <tbody>
                                <?php foreach($product as $key =>$item){  ?>
                                <?php 
                                    $uploads = UploadsProduct::find()->where(['ref'=>$item[0]['ref']])->asArray()->all();
                                    $category = Categorys::find()->where(['category_id'=>$item[0]['category_id']])->asArray()->one();
                                    $brand = Brands::find()->where(['brand_id'=>$item[0]['brand_id']])->asArray()->one();
                                ?>
                                <tr>
                                    <td>
                                    <img src="<?= Yii::getAlias('@web').'/products/'.$uploads[0]['ref'].'/'.$uploads[0]['real_filename']?>" alt="img" width="146" height="132">
                                    <?= $item[0]['product_name'] ?></a>
                                    </td>
                                    <td><?= $category['category_name']?></td>
                                    <td><?= $brand['brand_name']?></td>
                                    <td>RM <?= $item[0]['product_price'] ?></td>
                                    <td><?= $order[$key]['quantity']?></td>
                                    <td>RM <?= $order[$key]['total_price']?></td>
                                    
                                </tr>
                                
                                <?php } ?>
                            </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
</div>
