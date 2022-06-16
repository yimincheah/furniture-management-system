<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use backend\models\UploadsProduct;

$this->title = 'Product List';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
	<div class="container-fluid">
		<div class="row">
			<div class="breadcrumb-content">
				<h2>Products</h2>
				<ul>
					<li><?= Html::a('Home', ['/']) ?></li>
					<li><?= Html::a('Products', ['/product-list/index']) ?></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<div id="content" class="products_page">
	<!-- products -->
	<div id="products" class="products_section">
		<div class="container-fluid">
			<?= common\widgets\Alert::widget() ?>
			<div class="row">
				<div class="col-sm-3">
					<div class="eb_right">
						<!-- all -->
						<div id="category" class="category">
							<ul class="wow fadeInDown animated">
								<li><a><i class="fa fa-angle-right" aria-hidden="true"></a></i><?= Html::a('All', ['/product-list/index']) ?></li>
							</ul>
						</div>
						<!-- all end-->
						<!-- category -->
						<div id="category" class="category">
							<h3 class="wow fadeInDown animated">category</h3>
							<?php foreach ($categories as $category) { ?>
								<ul class="wow fadeInDown animated">
									<li><a><i class="fa fa-angle-right" aria-hidden="true"></a></i><?= Html::a($category->category_name, ['product-list/category-list', 'id' => $category->category_id]) ?></li>
								</ul>
							<?php } ?>
						</div>
						<!-- category end-->
						<br>
						<!-- brand -->
						<div id="category" class="category">
							<h3 class="wow fadeInDown animated">brand</h3>
							<?php foreach ($brands as $brand) { ?>
								<ul class="wow fadeInDown animated">
									<li><a><i class="fa fa-angle-right" aria-hidden="true"></a></i><?= Html::a($brand->brand_name, ['product-list/brand-list', 'id' => $brand->brand_id]) ?></li>
								</ul>
							<?php } ?>
						</div>
						<!-- brand end-->

					</div>
				</div>

				<div class="col-sm-9">
					<div class="eb_left">
						<!-- product-list-top -->
						<div class="product-list-top">
							<div class="show-wrapper">
								<div class="col-md-6 col-xs-6 sort">
									<form action="<?= Url::to(['product-list/search']) ?>" method="post">
										<div class="form-group input-group input-group-sm wow fadeInDown pull-left">
											<label class="input-group-addon" for="input-limit">Search</label>
											<input class="form-control" id="searchName" type="text" name="searchName" data-constraints="@Required" placeholder="Product Name">
										</div>
									</form>
								</div>
							</div>
							<div class="clear"></div>
						</div>
						<!-- product-list-top -->
						<!--1 -->
						<?php foreach ($products as $product) { ?>
							<div class="col-sm-4">
								<div class="product-thumb">
									<div class="image wow fadeInDown animated">
										<?php
										$uploads = UploadsProduct::find()->where(['ref' => $product->ref])->all();
										?>
										<?= empty($uploads) ? Html::img(Yii::getAlias('@web') . '/products/blank.jpg', ['class' => 'wow fadeInDown animated', 'width' => '100%', 'height' => '100%', 'alt' => 'product', 'title' => 'product'])
											:  Html::img(Yii::getAlias('@web') . '/products/' . $product->ref . '/' . $uploads[0]['real_filename'], ['class' => 'wow fadeInDown animated', 'width' => '100%', 'height' => '100%', 'alt' => $product->product_name, 'title' => $product->product_name]) ?>

									</div>
									<div class="caption">

										<div class="rate-and-title">
											<h4 class="wow fadeInDown animated"><a href=""><?= $product->product_name ?></a></h4>
											<p class="price wow fadeInDown animated">
												<span class="price-new">RM <?= $product->product_price ?></span>
											</p>

											<?= Html::a('View', ['product-list/single-product', 'id' => $product->product_id], ['class' => 'btn btn-primary', 'style' => 'width: 250px']) ?>

										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<!-- products end -->
						<!-- Pagination -->
						<div class="clear"></div>
						<div class="pagination-section text-center wow fadeInDown animated">
							<?= LinkPager::widget(['pagination' => $pagination]) ?>
						</div>
						<!-- Pagination End-->
					</div>
				</div>

			</div>
		</div>
	</div>

</div>