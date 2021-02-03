<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<?php AppAsset::register($this); ?>
<!DOCTYPE html>
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

    <title><?= Html::encode($this->title) ?></title>

    <!-- vendor css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/lib/fontawesome-5.13/css/all.css" rel="stylesheet">
    <link href="/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="/lib/jquery.steps/css/jquery.steps.css" rel="stylesheet"
    <?php $this->registerCsrfMetaTags() ?>
    <!-- Slim CSS -->
    <link rel="stylesheet" href="/css/slim.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="slim-header with-sidebar">
    <div class="my-container-fluid">
        <div class="slim-header-left">

            <h2 class="slim-logo"><?= Html::a(Html::img(Url::to('/image/logo.png')),  Yii::$app->params['backend-url'])  ?></h2>
            <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a>
<!--            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>-->

        </div><!-- slim-header-left -->
        <div class="slim-header-right">
            <div class="dropdown dropdown-c">
                <a href="#" class="logged-user" data-toggle="dropdown">
                    <img src="http://via.placeholder.com/500x500" alt="">
                    <span><?=Yii::$app->user->identity->username; ?></span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <nav class="nav">
                   <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout'); ?>" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
                    </nav>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </div>
    </div><!-- container-fluid -->
</div><!-- slim-header -->

<div class="slim-body">
    <div class="slim-sidebar">
        <ul class="nav nav-sidebar">
            <li class="sidebar-nav-item">
                <a href="/" class="sidebar-nav-link"><i class="fas fa-home"></i> Dashboard</a>
            </li>
            <li class="sidebar-nav-item">
                <a href="/staff/index" class="sidebar-nav-link"><i class="fas fa-theater-masks"></i> Staff</a>
            </li>
            <li class="sidebar-nav-item">
                <a href="/performance/index" class="sidebar-nav-link"><i class="fab fa-pinterest-p"></i> Performances</a>
            </li>
            <li class="sidebar-nav-item">
                <a href="/news/index" class="sidebar-nav-link"><i class="fas fa-newspaper"></i> News</a>
            </li>
            <li class="sidebar-nav-item">
                <a href="/archive/index" class="sidebar-nav-link"><i class="fas fa-archive"></i> Archive</a>
            </li>
            <li class="sidebar-nav-item with-sub">
                <a class="sidebar-nav-link"><i class="fas fa-cogs"></i> Settings </a>
                <ul class="nav sidebar-nav-sub">
                    <li class="nav-sub-item"><a href="/genre/index" class="nav-sub-link"><i class="fab fa-glide-g"></i> &nbsp;Genre</a></li>
                    <li class="nav-sub-item"><a href="/role/index" class="nav-sub-link"><i class="fas fa-user-friends"></i> &nbsp;Role</a></li>
                    <li class="nav-sub-item"><a href="/type/index" class="nav-sub-link"><i class="fas fa-user-friends"></i> &nbsp;Type</a></li>
                </ul>
            </li>

        </ul>
    </div><!-- slim-sidebar -->

    <div class="slim-mainpanel">
        <div class="container-fluid">

             <?= $content; ?>
        </div><!-- container -->

        <div class="slim-footer mg-t-0">
            <div class="container-fluid">
                <p>Copyright 2020 &copy; <b>Brainfors</b></p>
            </div><!-- container-fluid -->
        </div><!-- slim-footer -->
    </div><!-- slim-mainpanel -->
</div><!-- slim-body -->


<!--<script src="/lib/jquery/js/jquery.js"></script>-->
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="/lib/popper.js/js/popper.js"></script>
<script src="/lib/bootstrap/js/bootstrap.js"></script>
<script src="/lib/jquery.cookie/js/jquery.cookie.js"></script>
<script src="/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/lib/jquery.steps/js/jquery.steps.js"></script>
<script type="text/javascript" src="/js/angular/angular.min.js"></script>
<script type="text/javascript" src="/js/angular/app.js"></script>
<script src="/js/slim.js"></script>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>