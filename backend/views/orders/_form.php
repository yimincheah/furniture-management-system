<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);

?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'delivery_date')->widget(
        DatePicker::class, [
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]
    );?>

    <?= $form->field($model, 'order_status')->dropDownList(
        [ 
            '0' => 'Processing', 
            '1' => 'Delivered', 
            '2' => 'Cancelled', 
        ], 
        ['prompt' => 'Status']
    ) ?>
    

    <?= $form->field($model, 'address_line1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_line2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>    

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->id], ['class'=>'btn', 'style' => 'background-color:black']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
