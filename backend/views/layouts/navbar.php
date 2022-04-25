<?php

use yii\bootstrap4\Html;

?>

<!-- Start Navbar Area -->
<div class="navbar-area">
	<div class="furniture-responsive-nav">
		<div class="container-fluid">
			<div class="row">
				<div class="furniture-responsive-menu">
					<div class="logo">
					<img src="<?= Yii::$app->request->baseUrl ?>/image/logo/logo.png" alt="logo">
					</div>
					<?php if(! Yii::$app->user->isGuest) {?>	
					<div class="others-option align-items-center">
						<div class="option-item">
							<div class="cart-btn">
								<?= Html::a('<i class="fa fa-shopping-cart"></i>', ['/cart/index']) ?>
							</div>
						</div>
					</div>
					<?php } ?>
				<!--mobile Menu  -->

				<div id="mySidenav" class="sidenav">
					<div class="menu_slid_bg">
						<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
						
							<div class="col-sm-12" style="padding: 0; width: 250px; right: 15px; ">
								<h3>Furniture SG</h3>
								
								<ul class="accordion" id="accordion-category">

								<?php if(!Yii::$app->user->isGuest && Yii::$app->user->can('admin')) {?>
									<li class="panel mobile_menu_li">
										<?= Html::a('Home', ['/'], ['class' => 'mar-mobile']) ?>
									</li>
									<li class="panel mobile_menu_li">
										<?= Html::a('Furniture', ['/product-list/index'], ['class' => 'mar-mobile']) ?>
									</li>
									<li class="panel mobile_menu_li">
										<?= Html::a('Customer', ['/customers/index'], ['class' => 'mar-mobile']) ?>
									</li>
									
										<div id="category84" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
									<ul >
										<li><div class="row">
											<div class="col-menu col-md-3">
											<h6 class="title">Tables</h6>
												<div class="content">
												<ul class="menu-col">
													<li><a href="products.html">Side Table</a></li>
													<li><a href="products.html">Dressing Table</a></li>
													<li><a href="products.html">Coffee Table</a></li>
													<li><a href="products.html">Computer Table</a></li>
													<li><a href="products.html">Office Table</a></li>
												</ul>
											</div>
										</div><!-- end col-3 -->
										<div class="col-menu col-md-3">
											<h6 class="title">Chair</h6>
											<div class="content">
												<ul class="menu-col">
													<li><a href="products.html">Side Table</a></li>
													<li><a href="products.html">Dressing Table</a></li>
													<li><a href="products.html">Coffee Table</a></li>
													<li><a href="products.html">Computer Table</a></li>
													<li><a href="products.html">Office Table</a></li>
												</ul>
											</div>
										</div><!-- end col-3 -->
										<div class="col-menu col-md-3">
											<h6 class="title">Wardrobe</h6>
											<div class="content">
												<ul class="menu-col">
													<li><a href="products.html">Side Table</a></li>
													<li><a href="products.html">Dressing Table</a></li>
													<li><a href="products.html">Coffee Table</a></li>
													<li><a href="products.html">Computer Table</a></li>
													<li><a href="products.html">Office Table</a></li>
												</ul>
											</div>
										</div>
										<div class="col-menu col-md-3">
											<h6 class="title">Best Selling</h6>
											<div class="content">
												<ul class="menu-col">
													<li><a href="products.html">Side Table</a></li>
													<li><a href="products.html">Dressing Table</a></li>
													<li><a href="products.html">Coffee Table</a></li>
													<li><a href="products.html">Computer Table</a></li>
													<li><a href="products.html">Office Table</a></li>
												</ul>
											</div>
										</div><!-- end col-3 -->
									</div><!-- end row -->
								</li>
							</li>
							</ul>
						</div>
								</li> 
									
									</li>
									<li class="panel mobile_menu_li">
										<a href="#" class="mar-mobile">Management</a>
											<span class="head"><a style="" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-category" href="#category85" aria-expanded="false">
											<span class="plus">+</span><span class="minus">-</span></a></span>
											<div id="category85" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
												<ul>
													<li><?= Html::a('Manage Brand', ['/brands/index'], ['class' => 'nav-link']) ?></li>
													<li><?= Html::a('Manage Category', ['/categorys/index'], ['class' => 'nav-link']) ?></li>
													<li><?= Html::a('Manage Product', ['/products/index'], ['class' => 'nav-link']) ?></li>
													<li><?= Html::a('Manage Order', ['/orders/index'], ['class' => 'nav-link']) ?></li>
												</ul>
											</div>
									</li>
									
									<li class="panel mobile_menu_li">
										<a href="#" class="mar-mobile">Staff</a>
											<span class="head"><a style="" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-category" href="#category86" aria-expanded="false">
											<span class="plus">+</span><span class="minus">-</span></a></span>
											<div id="category86" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
												<ul>
													<li><?= Html::a('Manage Staff', ['/staff/index'], ['class' => 'nav-link']) ?></li>
												</ul>
											</div>
									</li>

									<li class="panel mobile_menu_li">
										<a href="#" class="mar-mobile">Schedule</a>
											<span class="head"><a style="" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-category" href="#category87" aria-expanded="false">
											<span class="plus">+</span><span class="minus">-</span></a></span>
											<div id="category87" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
												<ul>
													<li><?= Html::a('View Schedule', ['/schedule/index'], ['class' => 'nav-link']) ?></li>
												</ul>
											</div>
									</li>
								
									<li class="panel mobile_menu_li"><?= Html::a('Profile', ['/user/view', 'id' => Yii::$app->user->id], ['class' => 'mar-mobile']) ?></li>

									<li class="panel mobile_menu_li"><?= Html::a('Logout ('.Yii::$app->user->identity->username.')', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'mar-mobile']) ?></li>
									
									<?php } ?>

									<?php if(!Yii::$app->user->isGuest && Yii::$app->user->can('staff')) {?>

										<li class="panel mobile_menu_li"><?= Html::a('Profile', ['/user/view', 'id' => Yii::$app->user->id], ['class' => 'mar-mobile']) ?></li>

										<li class="panel mobile_menu_li"><?= Html::a('Logout ('.Yii::$app->user->identity->username.')', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'mar-mobile']) ?></li>

									<?php }?>

									<?php if(Yii::$app->user->isGuest) {?>
									<li class="panel mobile_menu_li">
										<?= Html::a('Login', ['/site/login'], ['class' => 'mar-mobile']) ?>
									</li>
									<li class="panel mobile_menu_li">
									<?= Html::a('Register', ['/site/signup'], ['class' => 'mar-mobile']) ?>
									</li>
									<?php } ?>
									
								</ul>
						<div class="clear"></div>
						</div>
							
					</div>
				</div>

				<span class="menu_open" onclick="openNav()">&#9776; Menu</span>
				<!-- mobile Menu  end-->
				</div>
			</div>
		</div>
	</div>

	<div class="furniture-nav">
		<div class="container-fluid">
			<div class="row">
				<div class="header_menu_wrapper">
					<nav class="navbar navbar-expand-md navbar-light">
						<div class="navbar-brand">
							<img src="../../image/logo/logo.png" alt="logo">
						</div>

						<div class="collapse navbar-collapse mean-menu" style="display: block;">
							<ul class="navbar-nav">

								<?php if(!Yii::$app->user->isGuest) { ?>
								<li class="nav-item"><?= Html::a('Home', ['/']) ?></li>

								<?php if(Yii::$app->user->can('admin')) { ?>

									<li class="nav-item"><?= Html::a('Furniture', ['/product-list/index']) ?></li>

									<li class="nav-item"><?= Html::a('Customer', ['/customers/index']) ?></li>

									<li class="nav-item"><a href="#" class="nav-link">Management <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
											
											<li class="nav-item"><?= Html::a('Manage Brand', ['/brands/index'], ['class' => 'nav-link']) ?></li>
											<li class="nav-item"><?= Html::a('Manage Category', ['/categorys/index'], ['class' => 'nav-link']) ?></li>
											<li class="nav-item"><?= Html::a('Manage Product', ['/products/index'], ['class' => 'nav-link']) ?></li>
											<li class="nav-item"><?= Html::a('Manage Order', ['/orders/index'], ['class' => 'nav-link']) ?></li>
											
										</ul>
									</li>

									<li class="nav-item"><a href="#" class="nav-link">Staff <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
											<li class="nav-item"><?= Html::a('Manage Staff', ['/staff/index'], ['class' => 'nav-link']) ?></li>		
										</ul>
									</li>

									<li class="nav-item"><a href="#" class="nav-link">Schedule <i class="fa fa-angle-down"></i></a>
										<ul class="dropdown-menu">
											<li class="nav-item"><?= Html::a('View Schedule', ['/schedule/index'], ['class' => 'nav-link']) ?></li>		
										</ul>
									</li>

								<?php } ?>
								
								<li class="nav-item"><?= Html::a('Profile', ['/user/view', 'id' => Yii::$app->user->id]) ?></li>

								<li class="nav-item"><?= Html::a('Logout ('.Yii::$app->user->identity->username.')', ['site/logout'], ['data' => ['method' => 'post']]) ?></li>
							
							</ul>

							<div class="others-option align-items-center">
								<div class="option-item">
									<div class="cart-btn">
									<?= Html::a('<i class="fa fa-shopping-cart"></i>', ['/cart/index']) ?>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</nav>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Navbar Area --> 



