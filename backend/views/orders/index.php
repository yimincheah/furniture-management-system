<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\Orders;
use kartik\export\ExportMenu;
use dosamigos\datepicker\DatePicker;

$this->title = 'Orders';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);
?>

<style>

</style>
<?php


$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'order_id',
    [
        'label' => 'Customer Name',
        'attribute' => 'customer_id',
        'value' => 'customer.customer_name',
    ],
    [
        'attribute' => 'delivery_date',
        'value' => 'delivery_date',
        'format' => 'raw',
        'filter' => DatePicker::widget([
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
        'format' => 'raw',
        'filter' => DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'created_at',
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
        'attribute' => 'total_price',
        'format' => 'currency',
        'pageSummary' => true
    ],
    [
        'class' => yii\grid\ActionColumn::class,
        'header' => 'Actions',
        'headerOptions' => ['style' => 'color:black'],
        'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'],
    ],
];

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider2,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'pjaxContainerId' => 'kv-pjax-container',
    'showColumnSelector' => false,
    'exportContainer' => [
        'class' => 'btn-group mr-2 me-2'
    ],
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-outline-secondary btn-default',
        'itemsBefore' => [
            '<div class="dropdown-header">Export All Data</div>',
        ],
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
                'krajeeDialogSettings' => ['overrideYiiConfirm' => false, 'useNative' => true],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showPageSummary' => true,
                'rowOptions' => function ($model) {
                    if ($model->order_status == '2') {
                        return ['class' => 'danger'];
                    }
                    if ($model->order_status == '0') {
                        return ['class' => 'info'];
                    }
                },
                'columns' => $gridColumns,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                ],
                'export' => [
                    'label' => 'Page',
                ],
                'exportConfig' => [
                    GridView::CSV => true,
                    GridView::HTML => true,
                    GridView::TEXT => true,
                    GridView::EXCEL => true,
                ],
                'exportContainer' => [
                    'class' => 'btn-group mr-2 me-2'
                ],
                'toolbar' => [
                    '{export}',
                    $fullExportMenu,
                ]
            ]); ?>
        </div>
    </div>

</div>