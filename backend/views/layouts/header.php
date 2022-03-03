<?php

use backend\assets\AppAsset;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>
	<!-- Top Header -->
	<div class="top-header">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-lg-4 col-md-12">
					<ul class="top-header-contact-info">
						<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
						<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-linkedin"></i></a></li>
					</ul>
					</div>
						<div class="col-lg-4 col-md-12">
						<ul class="top-offer-content">
						    <li>Get Upto 50% Discount Everyday</li>
						</ul>
				   </div>
				
				<div class="col-lg-4 col-md-12">
				<?php if(Yii::$app->user->isGuest) { ?>
					<ul class="top-header-social header_account">
						<li class="fa fa-user" style="color:white"></li>
						<li><?= Html::a('Register', ['site/signup']) ?></li> <span></span>
						<li class="fa fa-sign-in" style="color:white"></li>
						<li><?= Html::a('Login', ['site/login']) ?></li> 
					</ul>
				<?php }?>
				</div>

			</div>
		</div>
	</div>
	<!-- End Top Header -->

  
