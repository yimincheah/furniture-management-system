<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Products;

$this->title = 'Products';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Product</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Product', ['/products/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">

    <?= common\widgets\Alert::widget() ?>

    <div class="container-fluid">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Products', ['create'], ['class' => 'btn']) ?>
        </p>
        <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->product_status == 'inactive')
                {
                    return ['class'=>'danger'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'product_name',
                [
                    'attribute' => 'product_price',
                    'format' => 'currency',
                ],
                [
                    'label' => 'Status',
                    'headerOptions' => ['style' => 'color:black'],
                    'filter' => Html::activeDropDownList($searchModel, 'product_status', Products::getProductStatusList(), ['prompt' => 'Status', 'class' => 'form-control']),
                    'content' => function ($model) {
                        return Products::getProductStatus($model['product_status']);
                    },
                ],
                [
                    'attribute'=>'category_id',
                    'value'=>'category.category_name',
                ],
                [
                    'attribute'=>'brand_id',
                    'value'=>'brand.brand_name',
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
