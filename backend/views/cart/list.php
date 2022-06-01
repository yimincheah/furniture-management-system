<?php 

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Customers;
use backend\models\UploadsProduct;
use dosamigos\datepicker\DatePicker;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                <h2>Checkout</h2>
                <ul>
                    <li><?= Html::a('Home', ['/']) ?></li>
                    <li><?= Html::a('Cart', ['/cart/index']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php $form = ActiveForm::begin();?>
<div id="content" class="cart_page checkout_page">
<!-- cart -->
	<div id="cart" class="cart_section checkout_section">
		<div class="container-fluid" id="checkout">
            <div class="row billing_and_payment_option wow fadeInDown   animated">
				<!-- Billing Address -->
				<div class="col-sm-6 col-lg-6">
					<h3>Delivery Address</h3>
					<div class="eb-mailform form-checkout" novalidate="novalidate">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-wrap">
									<label>Customer Name</label>
									<?= 
										$form->field($model, 'customer_id')->widget(Select2::classname(), [
										'data' =>  ArrayHelper::map(Customers::find()->where(['customer_status' => 'active'])->all(),'customer_id','customer_name'),
										'language' => 'en',
										'bsVersion' => '4.x',
										'size' => Select2::LARGE,
										'options' => ['placeholder' => 'Select customer name ...','id'=>'customer_id'],
										'pluginOptions' => [
											'allowClear' => true
										],
										])->label(false);
									?>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-wrap">
									<?= $form->field($model, 'address_line1')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-wrap">
									<?= $form->field($model, 'address_line2')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-wrap">
									<?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-wrap">
									<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-wrap">
									<?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-wrap">
									<?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-sm-6 col-lg-6">
					<h3>Delivery Date</h3>
					<div class="eb-mailform form-checkout" novalidate="novalidate">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-wrap">
									<label></label>
									<?= $form->field($model, 'delivery_date')->widget(
										DatePicker::className(), [
											'inline' => true, 
											'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
											'clientOptions' => [
												'autoclose' => true,
												'format' => 'yyyy-m-d'
											]
									])->label(false);?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="row your_cart wow fadeInDown   animated">
				<?php if(empty($carts)){  ?>
					<h3>No Cart</h3>
				<?php } else{ ?>
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
								<?php foreach($carts as $key => $cart) { ?>
									<?php $uploads = UploadsProduct::find()->where(['ref' => $cart['ref']])->all(); ?>
									<tr>
										<td>
											<a class="table-cart-figure" href="index.php?r=product-list/single-product&id=<?= $key ?>">
											<img src="<?= Yii::getAlias('@web').'/products/'.$uploads[0]['ref'].'/'.$uploads[0]['real_filename']?>" alt="<?= $uploads[0]['real_filename']?>" width="146" height="132"></a>
											<?= Html::a($cart['product_name'],['product-list/single-product','id' => $key],['class'=>'table-cart-link']) ?>
										</td>
										<td>RM <?= $cart['product_price']?></td>										
										<td>											
											<div class="table-cart-stepper">
												<div class="stepper ">
												<input class="form-input stepper-input" value="<?= $cart['qty']?>" disabled style="background-color:white; max-width:80px">
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

                <div class="group-xl group-justify  wow fadeInDown animated pull-right">
                    <div>
                        <div class="group-xl group-middle">
                            <div>
                                <div class="group-md group-middle">
                                <div class="heading-5 font-weight-medium text-gray-500">Total</div>
                                <div class="heading-3 font-weight-normal">RM <?= $sum ?></div>
                                </div>
                            </div>
                            <?= Html::submitButton('CONFIRM ORDER',['class'=>'btn']) ?>
                        </div>
                    </div>
                </div>
			</div>
		</div>	
	</div>	
<!-- cart end-->	
</div>
<?php $form = ActiveForm::end(); ?>


<?php
$script = <<< JS
$('#customer_id').change(function(){
    var id = $(this).val();
    $.get('index.php?r=cart/get-address',{id : id }, function(data){
        var data = $.parseJSON(data);

		if(data.addressLine2 == null)
		{
        	$('#orders-address_line2').attr('value',' ');  
		}
		else{
			$('#orders-address_line1').attr('value',data.addressLine1);
        	$('#orders-address_line2').attr('value',data.addressLine2);  
		}
      
        $('#orders-post_code').attr('value',data.postCode);  
        $('#orders-country').attr('value',data.country);  

		$.get('index.php?r=cart/get-state',{id : data.state}, function(data2){
			var data2 = $.parseJSON(data2);
			$('#orders-state').attr('value',data2.state_name);   
		}); 

		$.get('index.php?r=cart/get-city',{id : data.city}, function(data3){
			var data3 = $.parseJSON(data3);
			$('#orders-city').attr('value',data3.city_name);   
		}); 
		  
    });
});

JS;
$this->registerJs($script);
?>


