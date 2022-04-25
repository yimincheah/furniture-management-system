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
                    <li><?= Html::a('Order', ['/orders/index']) ?></li>
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
                    'value' => ''
                ],
                [
                    'attribute' => 'order_status',
                    'value' => function ($model) {
                        return ($model['order_status'] == '1' ? 'Delivered' : 'Processing' );
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

    <p>
        <?= Html::a('Update', ['update-schedule', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['schedule', 'id' => $model->id], ['class'=>'btn btn-danger']) ?>
    </p> 

    </div>
</div>