<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Orders;
use dosamigos\datepicker\DatePicker;

$this->title = 'Manage Schedule';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                    <h2>Schedule</h2>
                    <ul>
                        <li><?= Html::a('Home', ['/']) ?></li>
                        <li><?= Html::a('Schedule', ['/schedule/index']) ?></li>
                    </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">

    <div class="container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= common\widgets\Alert::widget() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            ['class' => 'yii\grid\SerialColumn','header'=>'No','headerOptions' => ['style' => 'color:black']],
            
            'order_id',
            [
                'label' => 'Staff Name',
                'attribute'=>'staff_id',
                'value'=>'staff.username',
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
                'contentOptions' => ['style' => 'white-space: nowrap;width: 150px'], 
            ],
            [
                'class' => yii\grid\ActionColumn::class,
                'header'=>'Actions',
                'template' => '{update} {send}',
                'headerOptions' => ['style' => 'color:black'],
                'contentOptions' => ['style' => 'white-space: nowrap;width: 50px'],  
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-pencil"></span>', \yii\helpers\Url::to([
                                            'schedule/update',
                                            'id' => $model['id']
                                        ])
                        );
                    },
                    'send' => function ($url, $model, $key) {
                        return
                                Html::a('<span class="fa fa-send"></span>',  \yii\helpers\Url::to([
                                    'schedule/send-notification',
                                    'staff_id' => $model['staff_id'],
                                    'id' => $model['id']
                                ])
                        );
                    },
                ]
            ],
        ],
    ]); ?>

    </div>
</div>
