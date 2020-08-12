<!DOCTYPE html>
<?php

use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="lang="<?= Yii::$app->language ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Slim Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="/lib/jquery.steps/css/jquery.steps.css" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <!-- Slim CSS -->
    <link rel="stylesheet" href="/css/slim.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="slim-header with-sidebar">
    <div class="container-fluid">
        <div class="slim-header-left">

            <h2 class="slim-logo"><a href="index.html">Autotech<span>.</span></a></h2>
            <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a>
            <!--            <div class="search-box">-->
            <!--                <input type="text" class="form-control" placeholder="Search">-->
            <!--                <button class="btn btn-primary"><i class="fa fa-search"></i></button>-->
            <!--            </div>-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
