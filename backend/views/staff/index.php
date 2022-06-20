<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Uploads;

$this->title = 'Staff';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);
?>
<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Staff</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Staff', ['/staff/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">

    <?= common\widgets\Alert::widget() ?>

    <div class="container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'user.ref',
                'label'=>'Profile Picture',
                'format' => 'html',
                'value'=>function($data){
                    $uploads = Uploads::find()->where(['ref' => $data->user->ref])->one();
                    if(!empty($uploads)){
                        return Html::img(Yii::getAlias('@web').'/profile/'.$data->user->ref.'/'.$uploads->real_filename, ['width' => '80px']);
                    }
                },   
            ],
            [
                'attribute'=>'Staff Name',
                'value'=>'user.username',
            ],
            [
                'class' => yii\grid\ActionColumn::class,
                'header'=>'Actions',
                'template' => '{view} {delete}',
                'headerOptions' => ['style' => 'color:black'],
                'contentOptions' => ['style' => 'white-space: nowrap;width: 80px'],
            ],
        ],
    ]); ?>

    </div>
</div>
