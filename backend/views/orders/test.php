<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\Orders;
use kartik\export\ExportMenu;
use dosamigos\datepicker\DatePicker;
use kartik\date\DatePicker as Date2;
//use jino5577\daterangepicker\DateRangePicker;
use kartik\daterange\DateRangePicker;


$this->title = 'Orders';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<?php

$customDropdown = [
    'options' => ['tag' => false], 
    'linkOptions' => ['class' => 'dropdown-item']
];

$gridColumns = [
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
        'attribute' => 'created_at',
        'value' => 'created_at',
        'filterType' => GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' =>([
        'model'=>$searchModel,
        'presetDropdown'=>TRUE,                
        'convertFormat'=>true,                
        'pluginOptions'=>[                                          
            'format'=>'Y-m-d',
            'opens'=>'left'
        ]])
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

];

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'asDropdown' => false, // this is important for this case so we just need to get a HTML list    
    'dropdownOptions' => [
        'label' => '<i class="fas fa-external-link-alt"></i> Full'
    ],
    'exportConfig' => [ // set styling for your custom dropdown list items
        ExportMenu::FORMAT_CSV => $customDropdown,
        ExportMenu::FORMAT_TEXT => $customDropdown,
        ExportMenu::FORMAT_HTML => $customDropdown,
        ExportMenu::FORMAT_PDF => $customDropdown,
        ExportMenu::FORMAT_EXCEL => $customDropdown,
        ExportMenu::FORMAT_EXCEL_X => $customDropdown,
    ],
]);

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
                /*[
                    'filter' => Date2::widget([
                        'model' => $searchModel,
                        'attribute' => 'startDate',
                        'attribute2' => 'endDate',
                        'type' => Date2::TYPE_RANGE,
                        'separator' => '<span class="input-group-text">-</span>',
                        'layout' => '{input1} {separator} {input2} <span class="input-group-text kv-date-remove">
                        <i class="fa fa-times kv-dp-icon"></i>
                        </span>',
                        'pluginOptions' => ['format' => 'yyyy-mm-dd', 'autoclose' => true,]
                    ]),
                    'attribute' => 'created_at',
                    'format' => 'date',
                    'contentOptions' => ['style' => 'white-space: nowrap;width: 120px'], 
                ],*/
                // [
                //     'attribute'=> 'created_at',
                //     'value' => 'created_at',
                //     'filter'=>DateRangePicker::widget([
                //         'model' => $searchModel,
                //         //'value' => $searchModel->startDate . ' - ' . $searchModel->endDate,
                //         'attribute' => 'created_at',
                //         //'useWithAddon'=>true,
                //         'convertFormat'=>true,
                //         //'presetDropdown'=>true,
                //         //'hideInput'=>true,
                //         'startAttribute' => 'startDate',
                //         'endAttribute' => 'endDate',
                //         'pluginOptions'=>[
                //             // 'locale'=>['format' => 'Y-m-d H:i:s'],
                //             // 'opens' => 'left',
                //             // 'timePicker' => false
                //             'format' => 'd-m-Y',
                //             'autoUpdateInput' => false
                //         ] 
                //     ]),
                // ],
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'filterType' => GridView::FILTER_DATE_RANGE,
                    'filterWidgetOptions' =>([
                    'model'=>$searchModel,
                    'presetDropdown'=>TRUE,                
                    'convertFormat'=>true,                
                    'pluginOptions'=>[                                          
                        'format'=>'Y-m-d',
                        'opens'=>'left'
                    ]])
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

