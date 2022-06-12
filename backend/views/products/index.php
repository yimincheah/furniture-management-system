<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Products;

$this->title = 'Products';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);
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
            <?= Html::a('Create Product', ['create'], ['class' => 'btn']) ?>
        </p>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
                            if ($model->product_status == '0') {
                                return '<span class="badge btn-danger">' . Products::getProductStatus($model['product_status']) . '<spnn>';
                            } else if ($model->product_status == '1') {
                                return '<span class="badge btn-success">' . Products::getProductStatus($model['product_status']) . '<spnn>';
                            }
                        },
                    ],
                    [
                        'attribute' => 'category_id',
                        'value' => 'category.category_name',
                    ],
                    [
                        'attribute' => 'brand_id',
                        'value' => 'brand.brand_name',
                    ],
                    [
                        'class' => yii\grid\ActionColumn::class,
                        'header' => 'Actions',
                        'headerOptions' => ['style' => 'color:black'],
                        'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'],
                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>