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
								<a href="cart.html"><i class="fa fa-shopping-cart"></i><span>1</span></a>
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

								<?php if(!Yii::$app->user->isGuest) {?>
									<li class="panel mobile_menu_li">
										<?= Html::a('Home', ['/'], ['class' => 'mar-mobile']) ?>
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
										<a href="#" class="mar-mobile">Shop</a>
											<span class="head"><a style="" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-category" href="#category85" aria-expanded="false">
											<span class="plus">+</span><span class="minus">-</span></a></span>
											<div id="category85" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
												<ul>
													<li>
															<a href="services.html">Products List</a>
													</li>
													<li>
															<a href="cart.html">Cart</a>
													</li>
													<li>
															<a href="checkout.html">Checkout</a>
													</li>
													<li>
															<a href="single-products.html">Products Details</a>
													</li>
													<li>
															<a href="404.html">404</a>
													</li>
												</ul>
											</div>
									</li>
									
									<li class="panel mobile_menu_li">
										<a href="#" class="mar-mobile">Blog</a>
											<span class="head"><a style="" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-category" href="#category86" aria-expanded="false">
											<span class="plus">+</span><span class="minus">-</span></a></span>
											<div id="category86" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
												<ul>
													<li>
															<a href="blog.html">Blog Grid</a>
													</li>
													<li>
															<a href="blog-left.html">Blog Grid View Left</a>
													</li>
													<li>
															<a href="blog-right.html">Blog Grid View right</a>
													</li>
													<li>
															<a href="blog-details.html">Blog Details</a>
													</li>
												</ul>
											</div>
									</li>
								
									<li class="panel mobile_menu_li">
										<a href="#" class="mar-mobile">my Account</a>
											<span class="head"><a style="" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-category" href="#category87" aria-expanded="false">
											<span class="plus">+</span><span class="minus">-</span></a></span>
											<div id="category87" class="panel-collapse collapse" style="clear: both; height: 0px;" aria-expanded="false">
												<ul>
													<li>
															<a href="login.html"> Login </a>
													</li>
													<li>
															<a href="register.html"> Register</a>
													</li>
												</ul>
											</div>
									</li>
									<?php } ?>

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

								<li class="nav-item"><a href="#" class="nav-link">Pages <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu">

										<li class="nav-item"><a href="#" class="nav-link">Shop <i class="fa fa-angle-right"></i></a>
											<ul class="dropdown-menu">
												<li class="nav-item"><a href="products.html" class="nav-link">Products List</a></li>

												<li class="nav-item"><a href="cart.html" class="nav-link">Cart</a></li>

												<li class="nav-item"><a href="checkout.html" class="nav-link">Checkout</a></li>

												<li class="nav-item"><a href="single-products.html" class="nav-link">Products Details</a></li>
											</ul>
										</li>

										<li class="nav-item"><a href="404.html" class="nav-link">404</a></li>
									</ul>
								</li>

								<li class="nav-item"><a href="#" class="nav-link">Blog <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu">
										<li class="nav-item"><a href="blog.html" class="nav-link">Blog Grid</a></li>
										
										<li class="nav-item"><a href="blog-left.html" class="nav-link">Blog Grid View Left</a></li>
										
										<li class="nav-item"><a href="blog-right.html" class="nav-link">Blog Grid View right</a></li>

										<li class="nav-item"><a href="blog-details.html" class="nav-link">Blog Details</a></li>
									</ul>
								</li>
							
								<li class="nav-item"><?= Html::a('Logout ('.Yii::$app->user->identity->username.')', ['site/logout'], ['data' => ['method' => 'post']]) ?></li>
							
							</ul>

							<div class="others-option align-items-center">
								<div class="option-item">
									<div class="cart-btn">
										<a href="cart.html"><i class="fa fa-shopping-cart"></i><span>1</span></a>
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



