<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'View Product';

\yii\web\YiiAsset::register($this);
$this->registerCss($this->render('gallery.css'));
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Product</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Product', ['/product/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">
    <div class="container-fluid">

        <h1><?= Html::encode($this->title) ?></h1>

        <div>
            <?= dosamigos\gallery\Carousel::widget(['items' => $model->getThumbnails($model->ref, $model->product_name), 'options' => ['container' => '#']]); ?>
        </div>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'product_name',
                'product_description',
                [
                    'attribute' => 'product_price',
                    'format' => 'currency',
                ],
                [
                    'attribute' => 'product_status',
                    'value' => function ($model) {
                        return ($model['product_status'] == '1' ? 'Active' : 'Inactive');
                    },
                ],
                'category.category_name',
                'brand.brand_name',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->product_id], ['class' => 'btn', 'style' => 'background-color:black']) ?>
        </p>

    </div>

</div>