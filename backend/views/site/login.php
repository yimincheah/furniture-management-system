<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;


$this->title = 'Login';
?>

<div id="content" class="login_page">
	<div id="register" class="register_section">
		<div class="container-fluid" id="checkout">
				
			<div class="row billing_and_payment_option wow fadeInDown   animated">
				<div class="heading_wrapper wow fadeInDown animated">
					<h2 class="wow fadeInDown animated">Login your Account</h2>
					<p class="wow fadeInDown animated">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </p>
				</div>
				<!-- Billing Address -->
				<div class="login_box">
					<h3>Your Account</h3>
                    <?php $form = ActiveForm::begin(['id' => 'login-form','enableClientScript' => false,]); ?>
						<form class="eb-form eb-mailform form-checkout" novalidate="novalidate">
							<div class="form-wrap">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
							</div>
							<div class="form-wrap">
                                <?= $form->field($model, 'password')->passwordInput() ?>
							</div>
							
							<?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
						</form>
                    <?php ActiveForm::end(); ?>
					<div class="clear"></div>
				</div>
				
			</div>
			
		</div>	
	</div>		
</div>


