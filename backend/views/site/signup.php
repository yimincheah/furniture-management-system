<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
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

                        <?= $form->field($model, 'contactNo') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?php               
                        $authItems=ArrayHelper::map($authItems,'name','name');  
                        ?>
                        <?php 
                        $model->permissions='admin';
                        ?>

                        <?= $form->field($model,'permissions')->radioList($authItems); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                    
                        <?php ActiveForm::end(); ?>
                   
                </div>	
			</div>
		</div>	
	</div>	
</div>




