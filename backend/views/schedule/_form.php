<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\User;
use backend\models\AuthAssignment;
use dosamigos\datepicker\DatePicker;

$user_staff = AuthAssignment::find()->where(['item_name'=>'staff'])->asArray()->all();

foreach($user_staff as $key=>$staff){
    $data = $key;
    $id[] = $user_staff[$data]['user_id'];
}

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);

?>

<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>

    <label>Staff Name</label>

    <?= 
        $form->field($model, 'staff_id')->widget(Select2::class, [
        'bsVersion' => '4.x',
        'id' => 'staff_id',
        'size' => Select2::LARGE,
        'data' =>  ArrayHelper::map(User::find()->where(['id'=>$id])->all(),'id','username'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a staff ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ])->label(false);
    ?>

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
        <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->id], ['class'=>'btn', 'style' => 'background-color:black']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<br>
</div>
