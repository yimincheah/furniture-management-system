<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'View Customer';
\yii\web\YiiAsset::register($this);
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
   <div class="container-fluid">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'customer_id',
                'customer_name',
                'customer_status',
                'customer_email:email',
                'customer_contact',
                [
                    'attribute' =>'address',
                    'value' => $model->addressLine1.", ".$model->addressLine2.", ".$model->postCode.", ".$model->cityName->city_name.", ".$model->stateName->state_name.", ".$model->country
                ],
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->customer_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->customer_id], ['class'=>'btn', 'style' => 'background-color:black']) ?>
        </p>

    </div>
</div>
