<?php

use yii\helpers\Html;

$this->title = 'Update Product';
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
    <div class="container-fluid">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ]) ?>

    </div>
</div>