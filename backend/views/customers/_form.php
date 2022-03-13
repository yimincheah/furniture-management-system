<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
use backend\models\States;
use backend\models\City;
use yii\helpers\ArrayHelper;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['class' => 'form-control'], ['options' => ['active' => ['Selected' => true]]]) ?>
    
    <?= $form->field($model, 'customer_email')->textInput(['maxlength' => true]) ?>
  
    <label>Contact No</label>
    <?= $form->field($model, 'customer_contact')->widget(
        PhoneInput::className(), [
        'jsOptions' => [
            'preferredCountries' =>['my'],
        ],
        'defaultOptions' => [
            'class' => 'form-control',
            'max-length' => '255'
        ]
    ])->label(false); ?>

    <?= $form->field($model, 'addressLine1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addressLine2')->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'state')->dropDownList(
        States::getStateList(),
        [ 
            'prompt' => 'Select State',
            'onchange' => '$.post("index.php?r=customers/city&id='.'"+$(this).val(), function(data){
                $("select#customers-city").html(data);
            });',
           
        ],
    );
    ?>

   

    <?php 
      if($model->isNewRecord)
      {
    ?>
        <?=$form->field($model, 'city')->dropDownList(
            City::getCityList(),
            [
                'prompt' => 'Select City',
            ],
        );?>
    
     <?php } else {?>
        <?=$form->field($model, 'city')->dropDownList(
            ArrayHelper::map(City::find()->where(['state_id' => $model->stateName->state_id])->all(),'city_id','city_name'),
            [
                'prompt' => 'Select City',
            ],
        );?>
        
     <?php }?>
   

    <?= $form->field($model, 'postCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true, 'value' => 'Malaysia']) ?>

    <br>
    <div class="form-group">
       
       <?php if($model->isNewRecord){ ?>
           <?= Html::submitButton('Save', ['class' => 'btn']) ?>
       
       <?php } 
       else{ ?>
           <?= Html::submitButton('Update', ['class' => 'btn']) ?>
           
       <?php }?>
   
       <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->customer_id], ['class'=>'btn', 'style' => 'background-color:black']) ?>
       
   </div>

    <?php ActiveForm::end(); ?>

</div>
