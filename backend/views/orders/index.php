<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use backend\models\Orders;
use dosamigos\datepicker\DatePicker;

$this->title = 'Orders';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
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

    <?= common\widgets\Alert::widget() ?>

    <div class="container-fluid">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'showPageSummary' => true,
            'rowOptions'=>function($model){
                if($model->order_status == '2')
                {
                    return ['class'=>'danger'];
                }
                if($model->order_status == '0')
                {
                    return ['class'=>'info'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'order_id',
                [
                    'label' => 'Customer Name',
                    'attribute'=>'customer_id',
                    'value'=> 'customer.customer_name',
                ],
                [
                    'attribute'=> 'delivery_date',
                    'value'=>'delivery_date',
                    'format'=>'raw',
                    'filter'=>DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'delivery_date',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                                'clearBtn' => true,
                            ],
                            'clientEvents' => [
                                'clearDate' => 'function (e) {$(e.target).find("input").change();}',
                            ],
                    ])
    
                ],
                [
                    'label' => 'Status',
                    'headerOptions' => ['style' => 'color:black'],
                    'filter' => Html::activeDropDownList($searchModel, 'order_status', Orders::getOrderStatusList(), ['prompt' => 'Status', 'class' => 'form-control']),
                    'content' => function ($model) {
                        return Orders::getOrderStatus($model['order_status']);
                    },
                    'contentOptions' => ['style' => 'white-space: nowrap;width: 120px'], 
                ],
                [
                    'attribute'=> 'created_at',
                    'value'=>'created_at',
                    'format'=>'datetime',
                    'filter'=>DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                            'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd MM yyyy',
                                'clearBtn' => true,
                            ],
                            'clientEvents' => [
                                'clearDate' => 'function (e) {$(e.target).find("input").change();}',
                            ],
                    ])
                ],
                [
                    'attribute' => 'total_price',
                    'format' => 'currency',
                    'pageSummary' => true
                ],
                [
                    'class' => yii\grid\ActionColumn::className(),
                    'header'=>'Actions',
                    'headerOptions' => ['style' => 'color:black'],
                    'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'], 
                ],
            ],
        ]); ?>
        </div>
    </div>

</div>
