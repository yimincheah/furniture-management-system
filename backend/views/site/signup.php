<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;

$this->title = 'Signup';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div id="content" class="login_page">
	<div id="register" class="register_section">
		<div class="container-fluid" id="checkout">	
			<div class="row billing_and_payment_option wow fadeInDown animated">
				<div class="heading_wrapper wow fadeInDown animated">
					<h2 class="wow fadeInDown animated">Registration</h2>
					<p class="wow fadeInDown animated">All We Ask For Is Registration, Just Like We Do For Cars. We are really competing against ourselves, we have no control over how other people perform.</p>
				</div>
                <div class="login_box">
                    <h3>Create Your Account</h3>
                
                        <?php $form = ActiveForm::begin(['id' => 'form-signup','enableClientScript' => false]); ?>
                                       
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <label>Contact No</label>
                        <?= $form->field($model, 'contactNo')->widget(
                            PhoneInput::className(), [
                            'jsOptions' => [
                                'preferredCountries' =>['my'],
                            ],
                           
                        ])->label(false); ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?php               
                        $authItems=ArrayHelper::map($authItems,'name','name');  
                        ?>
                        <?php 
                        $model->permissions='admin';
                        ?>

                        <?= $form->field($model,'permissions')->radioList($authItems)->label(false); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                    
                        <?php ActiveForm::end(); ?>
                   
                </div>	
			</div>
		</div>	
	</div>	
</div>




