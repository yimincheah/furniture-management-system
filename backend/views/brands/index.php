<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Brands;
use dosamigos\datepicker\DatePicker;

$this->title = 'Brand';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);

?>


<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Brand</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Brand', ['/brands/index']) ?></li>
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
            <?= Html::a('Create Brands', ['create'], ['class' => 'btn']) ?>
        </p>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'brand_name',
                [
                    'label' => 'Status',
                    'headerOptions' => ['style' => 'color:black'],
                    'filter' => Html::activeDropDownList($searchModel, 'brand_status', Brands::getBrandStatusList(), ['prompt' => 'Status', 'class' => 'form-control']),
                    'content' => function ($model) {
                        if ($model->brand_status == 'inactive') {
                            return '<span class="badge btn-danger">' . Brands::getBrandStatus($model['brand_status']) . '<spnn>';
                        } else if ($model->brand_status == 'active') {
                            return '<span class="badge btn-success">' . Brands::getBrandStatus($model['brand_status']) . '<spnn>';
                        }
                    },
                ],
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'format' => 'datetime',
                    'filter' => DatePicker::widget([
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
                    'attribute' => 'updated_at',
                    'value' => 'updated_at',
                    'format' => 'datetime',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updated_at',
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
                    'class' => yii\grid\ActionColumn::class,
                    'header' => 'Actions',
                    'headerOptions' => ['style' => 'color:black'],
                    'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'],
                    'template' => ' {update}  {delete}',

                ],

            ],
        ]); ?>

    </div>
</div>