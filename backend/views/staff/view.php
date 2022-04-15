<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Uploads;

$this->title = "Staff";

\yii\web\YiiAsset::register($this);
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
   <div class="container-fluid">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'user.username',
            'user.email',
            'user.contactNo',
            'user.created_at:datetime'
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'item_name' => $model->item_name, 'user_id' => $model->user_id], ['class'=>'btn','style' => 'background-color:black']) ?>
    </p>
    </div>
</div>
