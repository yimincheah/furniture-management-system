<?php

use yii\helpers\Html;
use backend\models\UploadsProduct;
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
	<div class="container-fluid">
		<div class="row">
			<div class="breadcrumb-content">
				<h2>Cart</h2>
				<ul>
					<li><?= Html::a('Home', ['/']) ?></li>
					<li><?= Html::a('Cart', ['/cart/index']) ?></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<div id="content" class="cart_page checkout_page">
	<!-- cart -->
	<div id="cart" class="cart_section checkout_section">
		<div class="container-fluid" id="checkout">
			<?= common\widgets\Alert::widget() ?>
			<div class="row your_cart wow fadeInDown   animated">
				<?php if (empty($carts)) {  ?>
					<h3>No Cart</h3>
				<?php } else { ?>
					<div class="table-custom-responsive wow fadeInDown animated">
						<table class="table-custom table-cart table-responsive">
							<thead>
								<tr>
									<th>Product name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($carts as $key => $cart) { ?>
									<?php $uploads = UploadsProduct::find()->where(['ref' => $cart['ref']])->all(); ?>
									<tr>
										<td>
											<a class="table-cart-figure" href="index.php?r=product-list/single-product&id=<?= $key ?>">
												<?php if (!empty($uploads)) { ?>
													<img src="<?= Yii::getAlias('@web') . '/products/' . $uploads[0]['ref'] . '/' . $uploads[0]['real_filename'] ?>" alt="<?= $uploads[0]['real_filename'] ?>" width="146" height="132"></a>
										<?php } ?>
										<?= Html::a($cart['product_name'], ['product-list/single-product', 'id' => $key], ['class' => 'table-cart-link']) ?>
										</td>
										<td>RM <?= $cart['product_price'] ?></td>
										<td>
											<div class="table-cart-stepper">
												<div class="stepper ">
													<?= Html::a('<i class="fa fa-minus"></i>', ['cart/reduce-cart-quantity', 'id' => $key]) ?>
													<input class="form-input stepper-input" value="<?= $cart['qty'] ?>" disabled style="background-color:white; max-width:80px">
													<?= Html::a('<i class="fa fa-plus"></i>', ['cart/add-cart-quantity', 'id' => $key]) ?>
												</div>
											</div>
										</td>
										<td>RM <?= $cart['qty'] * $cart['product_price'] ?> </td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } ?>

				<br>
				<div class="group-middle">
					<div class="form-button">
						<?= Html::a('Clear', ['cart/clear-cart'], ['style' => 'color:white; background-color:black', 'class' => 'btn']) ?>
					</div>
				</div>
				<br>
				<div class="group-xl group-justify  wow fadeInDown animated pull-right">
					<div>
						<div class="group-xl group-middle">
							<div>
								<div class="group-md group-middle">
									<div class="heading-5 font-weight-medium text-gray-500">Total</div>
									<div class="heading-3 font-weight-normal">RM <?= $sum ?></div>
								</div>
							</div>
							<?php if (!empty($carts)) { ?>
								<?= Html::a('Proceed to checkout', ['cart/proceed-to-checkout'], ['class' => 'btn']) ?>
							<?php } else { ?>
								<button class="btn" style="padding:20px 20px" disabled>Proceed to checkout</button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- cart end-->
</div>
