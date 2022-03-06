<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
use backend\models\Categorys;

$this->title = 'Category';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>
<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Category</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Category', ['/category/index']) ?></li>
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
            <?= Html::a('Create Categorys', ['create'], ['class' => 'btn']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function($model){
                if($model->category_status == 'inactive')
                {
                    return ['class'=>'danger'];
                }
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'category_name',
                [
                    'label' => 'Status',
                    'headerOptions' => ['style' => 'color:black'],
                    'filter' => Html::activeDropDownList($searchModel, 'category_status', Categorys::getcategoryStatusList(), ['prompt' => 'Status', 'class' => 'form-control']),
                    'content' => function ($model) {
                        return Categorys::getCategoryStatus($model['category_status']);
                    },
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
                    'attribute'=> 'updated_at',
                    'value'=>'updated_at',
                    'format'=>'datetime',
                    'filter'=>DatePicker::widget([
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
                    'class' => yii\grid\ActionColumn::className(),
                    'header'=>'Actions',
                    'headerOptions' => ['style' => 'color:black'],
                    'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'],
                    'template'=>' {update}  {delete}',
                    
                ],
                
            ],
        ]); ?>

    </div>
</div>
