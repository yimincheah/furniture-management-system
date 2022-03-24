<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Product';
$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
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

<div id="content" class="single_products_page">
<!-- single products page -->
	<div id="products_products" class="single_products_section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="eb_right single_products_right_side">
						<div class="single_products_images">
							<div class="single_product_image">
								<div class="sp-loading">
                                    <?php if(!empty($uploads)) {?>
								    <img src="<?= Yii::getAlias('@web').'/products/'.$product->ref.'/'.$uploads[0]['real_filename']?>" alt="<?= $uploads[0]['file_name']?>" width="100%">
                                    <?php } ?>
								</div>
							</div>
							
							<div class="sp-wrap">
								<div id="additional_silder_products_images" class="owl-carousel">
									<div class="item">
                                        <?php foreach($uploads as $upload){?>
                                        <a href="<?php echo Yii::getAlias('@web').'/products/'.$product->ref.'/'.$upload['real_filename']?>">
											<img src="<?php echo Yii::getAlias('@web').'/products/'.$product->ref.'/'.$upload['real_filename']?>" alt="img">
										</a>
                                        <?php } ?>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="col-sm-6">
					<div class="eb_left single_products_left_side">
						<h2><?= $product->product_name ?></h2>	
						<hr>
						<div class="price-block">
							<div class="price-box">
								<p class="in-stock"><i class="fa fa-check"></i> In Stock</p>
								<p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price">RM <?= $product->product_price?> </span> </p>
							</div>
						</div>
						
						<div class="add-to-box">
							<div class="add-to-cart">
								<div class="pull-left">
									<div class="custom pull-left">
                                    <?= Html::beginForm(['cart/add-to-cart','product_id'=>$product->product_id,'post']) ?>
										<button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
										<input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
										<button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
									</div>
								</div>
								    <button class="btn btn-cart" title="Add to Cart" type="submit">Add to Cart</button>
                                    <input type="text" name="product_id" value="<?= $product->product_id ?>" hidden>
                                    <?= Html::endForm(); ?>
							</div>
						</div>
						
						<div class="short-description">
							<h3>Description</h3>
                            <p><?= $product->product_description ?></p>
						</div>
						
						<div class="email-addto-box">
							<ul class="add-to-links">
								<li> <p class="link-wishlist"><span><?= $brand->brand_name ?></span></p></li>
								<li><span class="separator">|</span> 
                                <p class="link-compare"><span><?= $category->category_name ?></span></p></li>
							</ul>
                      </div>
						<ul class="shipping-pro">
							<li>Free Shipping</li>
							<li>30 Days Return</li>
                        </ul>
						
					</div>	
				</div>
			</div>		
		</div>	
	</div>
</div>


