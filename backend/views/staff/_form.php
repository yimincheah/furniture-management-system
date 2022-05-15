<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);

?>

<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

    <?= $form->field($model, 'delivery_date')->widget(
        DatePicker::class, [
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ])?>

    <?= $form->field($model, 'order_status')->dropDownList(
        [ 
            '0' => 'Processing', 
            '1' => 'Delivered', 
            '2' => 'Cancelled', 
        ], 
        ['prompt' => 'Status']
    ) ?>

    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['view-schedule'], ['class'=>'btn', 'style' => 'background-color:black']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<br>
</div>
