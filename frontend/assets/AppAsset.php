<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'assets/bootstrap-4.5.2-dist/css/bootstrap.min.css',
        'assets/css/navstayle.css',
        'assets/css/media.css',
        'assets/libs/owlcarousel/owl.carousel.min.css',
        'assets/libs/owlcarousel/owl.theme.default.min.css',
        'assets/libs/fontawesome-free-5.13.1-web/css/all.css',
        'assets/gijgo-combined-1.9.13/css/gijgo.min.css',
    ];
    public $js = [
        //'assets/js/jquery-3.5.1.min.js',
        'assets/bootstrap-4.5.2-dist/js/bootstrap.min.js',
        'assets/libs/owlcarousel/owl.carousel.min.js',
        'assets/gijgo-combined-1.9.13/js/gijgo.min.js',
        'assets/libs/fontawesome-free-5.13.1-web/js/all.js',
        'assets/js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
