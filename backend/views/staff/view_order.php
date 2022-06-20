<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = 'Order Information';
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
                    <li><?= Html::a('Schedule', ['/staff/schedule']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="container" id="content">

    <h1><?= Html::encode($this->title) ?></h1>
	
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
                    'value' => $model->staff->username
                ],
                [
                    'attribute' => 'order_status',
                    'value' => function ($model) {
                        if($model->order_status == 0){
                            return 'Processing';
                        }else if($model->order_status == 1){
                            return 'Delivered';
                        }else{
                            return 'Cancelled';
                        }
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

    </div>
</div>