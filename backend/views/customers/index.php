<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Customers;

$this->title = 'Customer';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Customer</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Customer', ['/customers/index']) ?></li>
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
            <?= Html::a('Create Customers', ['create'], ['class' => 'btn']) ?>
        </p>

        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'customer_name',
                    [
                        'label' => 'Status',
                        'headerOptions' => ['style' => 'color:black'],
                        'filter' => Html::activeDropDownList($searchModel, 'customer_status', Customers::getCustomerStatusList(), ['prompt' => 'Status', 'class' => 'form-control']),
                        'content' => function ($model) {
                            if($model->customer_status == 'inactive')
                            {
                                return'<span class="badge btn-danger">'.Customers::getCustomerStatus($model['customer_status']).'<spnn>';
                            }
                            else if($model->customer_status == 'active'){
                                return '<span class="badge btn-success">'.Customers::getCustomerStatus($model['customer_status']).'<spnn>';
                            }
                        },
                    ],
                    'customer_email:email',
                    'customer_contact',
                    [
                        'class' => yii\grid\ActionColumn::class,
                        'header'=>'Actions',
                        'headerOptions' => ['style' => 'color:black'],
                        'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'],
                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>
