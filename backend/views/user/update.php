<?php

use yii\helpers\Html;

$this->title = 'Update Profile'
?>
<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Profile</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Profile', ['/user/view', 'id' => Yii::$app->user->id]) ?></li>
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
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig
        ]) ?>

    </div>
</div>
