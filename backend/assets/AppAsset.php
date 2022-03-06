<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
        'css/style.css',
        'css/responsive.css',
        'vendor/owl.carousel/assets/owl.carousel.css',
        'vendor/wow/animate.css',
        'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
        'vendor/slider-js/slideWiz.css',


    ];
    public $js = [
        'vendor/jquery/jquery.min.js',
        'vendor/owl.carousel/owl.carousel.min.js',
        'vendor/wow/wow.min.js',
        'vendor/slider-js/slideShow.js',
        'vendor/slider-js/slideWiz.js',
        'vendor/bootstrap/js/bootstrap.min.js',
        'js/custom.js',
        'js/modal.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
