<!DOCTYPE html>
<?php
use common\widgets\WLanguage;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

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
    <div class="container-fluid">
        <div class="slim-header-left">

            <h2 class="slim-logo"><?= Html::a(Html::img(Url::to('/image/logo.png')), Url::base())  ?></h2>
            <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a>
<!--            <div class="search-box">-->
<!--                <input type="text" class="form-control" placeholder="Search">-->
<!--                <button class="btn btn-primary"><i class="fa fa-search"></i></button>-->
<!--            </div>-->

        </div><!-- slim-header-left -->
        <div class="slim-header-right">
            <?= WLanguage::widget() ?>
            <div class="dropdown dropdown-a" data-toggle="tooltip" title="Activity Logs">
                <a href="" class="header-notification" data-toggle="dropdown">
                    <i class="icon ion-ios-bolt-outline"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-header">
                        <h6 class="dropdown-menu-title">Activity Logs</h6>
                        <div>
                            <a href="">Filter List</a>
                            <a href="">Settings</a>
                        </div>
                    </div><!-- dropdown-menu-header -->
                    <div class="dropdown-activity-list">
                        <div class="activity-label">Today, December 13, 2017</div>
                        <div class="activity-item">
                            <div class="row no-gutters">
                                <div class="col-2 tx-right">10:15am</div>
                                <div class="col-2 tx-center"><span class="square-10 bg-success"></span></div>
                                <div class="col-8">Purchased christmas sale cloud storage</div>
                            </div><!-- row -->
                        </div><!-- activity-item -->
                        <div class="activity-item">
                            <div class="row no-gutters">
                                <div class="col-2 tx-right">9:48am</div>
                                <div class="col-2 tx-center"><span class="square-10 bg-danger"></span></div>
                                <div class="col-8">Login failure</div>
                            </div><!-- row -->
                        </div><!-- activity-item -->
                        <div class="activity-item">
                            <div class="row no-gutters">
                                <div class="col-2 tx-right">7:29am</div>
                                <div class="col-2 tx-center"><span class="square-10 bg-warning"></span></div>
                                <div class="col-8">(D:) Storage almost full</div>
                            </div><!-- row -->
                        </div><!-- activity-item -->
                        <div class="activity-item">
                            <div class="row no-gutters">
                                <div class="col-2 tx-right">3:21am</div>
                                <div class="col-2 tx-center"><span class="square-10 bg-success"></span></div>
                                <div class="col-8">1 item sold <strong>Christmas bundle</strong></div>
                            </div><!-- row -->
                        </div><!-- activity-item -->
                        <div class="activity-label">Yesterday, December 12, 2017</div>
                        <div class="activity-item">
                            <div class="row no-gutters">
                                <div class="col-2 tx-right">6:57am</div>
                                <div class="col-2 tx-center"><span class="square-10 bg-success"></span></div>
                                <div class="col-8">Earn new badge <strong>Elite Author</strong></div>
                            </div><!-- row -->
                        </div><!-- activity-item -->
                    </div><!-- dropdown-activity-list -->
                    <div class="dropdown-list-footer">
                        <a href="page-activity.html"><i class="fa fa-angle-down"></i> Show All Activities</a>
                    </div>
                </div><!-- dropdown-menu-right -->
            </div><!-- dropdown -->
            <div class="dropdown dropdown-b" data-toggle="tooltip" title="Notifications">
                <a href="" class="header-notification" data-toggle="dropdown">
                    <i class="icon ion-ios-bell-outline"></i>
                    <span class="indicator"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-header">
                        <h6 class="dropdown-menu-title">Notifications</h6>
                        <div>
                            <a href="">Mark All as Read</a>
                            <a href="">Settings</a>
                        </div>
                    </div><!-- dropdown-menu-header -->
                    <div class="dropdown-list">

                        <!-- loop starts here -->
                        <a href="" class="dropdown-link">
                            <div class="media">
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <div class="media-body">
                                    <p><strong>Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                                    <span>October 03, 2017 8:45am</span>
                                </div>
                            </div><!-- media -->
                        </a>
                        <!-- loop ends here -->
                        <a href="" class="dropdown-link">
                            <div class="media">
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <div class="media-body">
                                    <p><strong>Mellisa Brown</strong> appreciated your work <strong>The Social Network</strong></p>
                                    <span>October 02, 2017 12:44am</span>
                                </div>
                            </div><!-- media -->
                        </a>
                        <a href="" class="dropdown-link read">
                            <div class="media">
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <div class="media-body">
                                    <p>20+ new items added are for sale in your <strong>Sale Group</strong></p>
                                    <span>October 01, 2017 10:20pm</span>
                                </div>
                            </div><!-- media -->
                        </a>
                        <a href="" class="dropdown-link read">
                            <div class="media">
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <div class="media-body">
                                    <p><strong>Julius Erving</strong> wants to connect with you on your conversation with <strong>Ronnie Mara</strong></p>
                                    <span>October 01, 2017 6:08pm</span>
                                </div>
                            </div><!-- media -->
                        </a>
                        <div class="dropdown-list-footer">
                            <a href="page-notifications.html"><i class="fa fa-angle-down"></i> Show All Notifications</a>
                        </div>
                    </div><!-- dropdown-list -->
                </div><!-- dropdown-menu-right -->
            </div><!-- dropdown -->
            <div class="dropdown dropdown-c">
                <a href="#" class="logged-user" data-toggle="dropdown">
                    <img src="http://via.placeholder.com/500x500" alt="">
                    <span><?=Yii::$app->user->identity->first_name?></span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <nav class="nav">
<!--                        <a href="page-profile.html" class="nav-link"><i class="icon ion-person"></i> View Profile</a>-->
<!--                        <a href="page-edit-profile.html" class="nav-link"><i class="icon ion-compose"></i> Edit Profile</a>-->
<!--                        <a href="page-activity.html" class="nav-link"><i class="icon ion-ios-bolt"></i> Activity Log</a>-->
                        <a href="<?php echo Yii::$app->urlManager->createUrl('companies/company-update'); ?>" class="nav-link"><i class="icon ion-ios-gear"></i> Account Settings</a>
                   <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout'); ?>" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
                    </nav>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </div><!-- header-right -->
    </div><!-- container-fluid -->
</div><!-- slim-header -->

<div class="slim-body">
    <div class="slim-sidebar">
        <?php if(!Yii::$app->user->identity->hasAccess('new')):?>
        <ul class="nav nav-sidebar">
            <li class="sidebar-nav-item">
<!--                with-sub-->
                <a href="/en/dashboard" class="sidebar-nav-link"><i class="fas fa-home"></i> Dashboard</a>
<!--                <ul class="nav sidebar-nav-sub">
                    <li class="nav-sub-item"><a href="index.html" class="nav-sub-link">Dashboard 01</a></li>
                    <li class="nav-sub-item"><a href="index2.html" class="nav-sub-link">Dashboard 02</a></li>
                    <li class="nav-sub-item"><a href="index3.html" class="nav-sub-link">Dashboard 03</a></li>
                    <li class="nav-sub-item"><a href="index4.html" class="nav-sub-link">Dashboard 04</a></li>
                    <li class="nav-sub-item"><a href="index5.html" class="nav-sub-link">Dashboard 05</a></li>
                </ul>-->
            </li>
            <li class="sidebar-nav-item">
                <a href="/en/actor/index" class="sidebar-nav-link"><i class="fas fa-theater-masks"></i> Actors</a>
            </li>
            <li class="sidebar-nav-item">
                <a href="/en/presentation/index" class="sidebar-nav-link"><i class="fab fa-pinterest-p"></i> Presentations</a>
            </li>
            <li class="sidebar-nav-item">
                <a href="/en/news/index" class="sidebar-nav-link"><i class="fas fa-newspaper"></i> News</a>
            </li>
<!--            <li class="sidebar-nav-item">
                <a href="page-messages.html" class="sidebar-nav-link"><i class="icon ion-ios-chatboxes-outline"></i> Messages</a>
            </li>-->

        </ul>
        <?php else:?>
        <li class="sidebar-nav-item ">
            <a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/index'); ?>" class="sidebar-nav-link active"><i class="icon ion-ios-information-outline"></i><?= Yii::t('app','Verification');?></a>
        </li>
        <?php endif;?>
    </div><!-- slim-sidebar -->

    <div class="slim-mainpanel">
        <div class="container-fluid">

             <?= $content; ?>
        </div><!-- container -->

        <div class="slim-footer mg-t-0">
            <div class="container-fluid">
                <p>Copyright 2020 &copy; All Rights Reserved. Slim Dashboard Template</p>
                <p>Designed by: <a href="">ThemePixels</a></p>
            </div><!-- container-fluid -->
        </div><!-- slim-footer -->
    </div><!-- slim-mainpanel -->
</div><!-- slim-body -->


<script src="/lib/jquery/js/jquery.js"></script>
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
