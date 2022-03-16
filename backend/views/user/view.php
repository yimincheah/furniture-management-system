<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Profile';
\yii\web\YiiAsset::register($this);
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

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute'=>'Profile Picture',
                    'value'=> (empty($model->ref) || empty($upload[0]['real_filename']) ) ? ' ': Yii::getAlias('@web').'/profile/'.$model->ref.'/'.$upload[0]['real_filename'],
                    'format' => ['image',['width'=>'150','height'=>'150']],
                ],
                'username',
                'email:email',
                'contactNo',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

    </div>
</div>
