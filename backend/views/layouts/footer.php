<?php

use yii\bootstrap4\Html;

?>

<!-- Footer Section -->
<footer id="footer" class="footer">
	<div class="container-fluid">
		<div class="row">           		
			<div class="footer_matter">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="footer_logo_wrapper">
						<!-- <img src="assets/image/logo/footer_logo.png" alt="footer_logo" class="img-responsive wow fadeInDown animated"> -->
						<h2 class="wow fadeInDown animated">Contact Detail</h2>
						   <ul>
								<li><i class="fa fa-map-marker"></i>3AB, Jalan Bunga Raya, Selangor, 45300 Sungai Besar</li>
								<li><i class="fa fa-phone"></i> Phone. (123) 456-7890</li>
								<li><i class="fa fa-fax"></i> Fax. (123) 456-7890</li>
								<li><i class="fa fa-envelope"></i> Email: company@Example.com</li>
								
							</ul>	
						
						<ul>
							<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
							<li class="wow fadeInDown animated"><a href="#"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="footer_list_wrapper">
						<h2 class="wow fadeInDown animated">Our Products</h2>
						   <ul class="extra-list list-unstyled">
								<li>Tables</li>
								<li>Chair</li>
								<li>Wardrobe</li>
								<li>Workstation</li>
								<li>Seating</li>
								<li>Education</li>
								<li>Equipment</li>
							</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="download_wrapper">
						<h2 class="wow fadeInDown animated">Our Brands</h2>
						<ul class="extra-list list-unstyled">
							<li>Sealy</li>
							<li>Best Home Furnishings</li>
							<li>Serta</li>
							<li>Hammary</li>
							<li>Stickley</li>
							<li>Lexington</li>
						</ul>
					</div>
				</div>		
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="footer_list_wrapper">
						<h2 class="wow fadeInDown animated">Quic Menu</h2>
						   <ul>
								<?php if(Yii::$app->user->isGuest) {?>	
								<li><?= Html::a('Login', ['/site/login']) ?></li>
								<li><?= Html::a('Register', ['/site/signup']) ?></li>
								<?php } ?>

								<?php if(!Yii::$app->user->isGuest && Yii::$app->user->can('admin')) {?>	
								<li><?= Html::a('Home', ['/']) ?></li>
								<li><?= Html::a('Profile', ['/user/view', 'id' => Yii::$app->user->id])?></li>
								<li><?= Html::a('Customer', ['/customers/index']) ?></li>
								<li><?= Html::a('Manage Brand', ['/brands/index']) ?></li>
								<li><?= Html::a('Manage Category', ['/categorys/index']) ?></li>
								<?php } ?>

								<?php if(!Yii::$app->user->isGuest && Yii::$app->user->can('staff')) {?>
								<li><?= Html::a('Profile', ['/user/view', 'id' => Yii::$app->user->id])?></li>

								<?php }?>
							</ul>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</footer>
	
<div class="footer_copyright">
    <div class="container-fluid">
        <p class="wow fadeInDown animated">© Copyright 2022 by SG BESAR Furniture Store. All right Reserved - Design By Cheah Yi Min</p>
    </div>
</div>

<!-- Footer Section End -->
<!-- back-to-top scrtion -->
<div class="top_button">
  <a class="back-to-top" style="cursor:pointer;" id="top-scrolltop"><i class="fa fa-angle-up"></i></a>
</div>
<!-- back-to-top scrtion End-->