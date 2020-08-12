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
        //'css/site.css',
    ];
    public $js = [

////        '/lib/jquery/js/jquery.js',
//        '/lib/popper.js/js/popper.js',
//        '/lib/bootstrap/js/bootstrap.js',
//        '/lib/jquery.cookie/js/jquery.cookie.js',
//        '/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js',
//        '/lib/jquery.steps/js/jquery.steps.js',
//        '/js/slim.js'

    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
