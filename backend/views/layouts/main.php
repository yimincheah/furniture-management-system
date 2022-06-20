<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\bootstrap4\Html;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php 
		$this->head() 
	?>

	<style>	
		.invalid-feedback{
			color: red;
		}

		.btn-warning {
			background: #f0ad4e;
		}
		.btn-danger {   
			background-color: #d9534f;
		}
		.btn-success {
			background-color: #5cb85c;
		}

		.btn:hover
		{
			background:#5cb85c;
			color:#ffffff;
		}

		.iti{
			width: 100%
		}

	</style>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header-area">
    <?php echo $this->render('header'); ?>
    <?php echo $this->render('navbar'); ?>
</header>


<?= $content ?>



<?php echo $this->render('footer'); ?>

<?php $this->endBody() ?>

<script>

$(document).ready(function(){
	$('#testimonial').owlCarousel({	
		items: 3,
		itemsDesktop:[1199,3],
		itemsDesktopSmall:[992,3],
		itemsTablet:[768,2],
		itemsMobile:[450,1],
		autoPlay: 10000,
		pagination: true,
		navigation: true,
		navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
	});

	$('#blog').owlCarousel({	
		items: 3,
		itemsDesktop:[1199,3],
		itemsDesktopSmall:[992,3],
		itemsTablet:[768,2],
		itemsMobile:[450,1],
		autoPlay: 10000,
		pagination: false,
		navigation: true,
		navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
	});

	$('#kvFileinputModal').remove();

	$('#additional_silder_products_images').owlCarousel({	
		items:5,
		itemsDesktop:[1199,3],
		itemsDesktopSmall:[992,2],
		itemsTablet:[768,3],
		itemsMobile:[600,2],
		autoPlay: 6000,
		pagination: false,
		navigation: true,
		navigationText: ['<i class="fa fa-angle-left fa-5x"></i>', '<i class="fa fa-angle-right fa-5x"></i>']
	});

	$('#related_product').owlCarousel({	
		items: 4,
		itemsDesktop:[1199,3],
		itemsDesktopSmall:[992,3],
		itemsTablet:[768,2],
		itemsMobile:[450,1],
		autoPlay: 10000,
		pagination: false,
		navigation: true,
		navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
	});

	$('.sp-wrap').smoothproducts();

});

</script>


</body>
</html>
<?php $this->endPage();
