<?php/* @var $this \yii\web\View *//* @var $content string */use common\models\Genre;use kartik\select2\Select2;use yii\helpers\ArrayHelper;use yii\helpers\Html;use yii\bootstrap\Nav;use yii\bootstrap\NavBar;use yii\helpers\Url;use yii\widgets\Breadcrumbs;use frontend\assets\AppAsset;use common\widgets\Alert;use common\models\Performance;AppAsset::register($this);?><?php $this->beginPage() ?><!DOCTYPE html><html lang="<?= Yii::$app->language ?>"><head>    <meta charset="<?= Yii::$app->charset ?>">    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta name="description" content="Գյումրու Վարդան Աճեմյանի անվան պետական դրամատիկական թատրոն (նախկինում՝ Ասքանազ Մռավյանի անվան, մինչև 1938 թ.-ը կոչվել է նաև Երկրորդ պետթատրոն), հիմնադրվել է 1928 թվականին, բացվել նոյեմբերի 1-ին «Խռովություն» ներկայացումով">    <meta name="keywords" content="Երկնագույն շան աչքերը, Հարսանիք թիկունքում, Harsaniq tikunqum,Գյումրու պետական դրամատիկական թատրոն ,Ոչինչ Չի Մնա ,Vochinch chi mna">    <?php $this->registerCsrfMetaTags() ?>    <title><?= Html::encode($this->title) ?></title>    <link rel="icon" type="image/png" href="/assets/images/logo.svg" />    <?php $this->head() ?>    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"          integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="          crossorigin="anonymous"></head><body class="pr-0 overflow-auto"><?php $this->beginBody() ?><div class="wrapper" style="background: #f6f6f6;">    <nav class="navbar navbar-expand-lg navbar-pages" style="z-index: 999">        <div class="container header_flex p-0">            <?= Html::a(Html::img(Url::to('/assets/images/logo.svg')),  '/', ['class' => 'navbar-brand logo']); ?>            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">					<span class="navbar-toggler-icon">						<i></i>						<i></i>						<i></i>					</span>            </button><!--            --><?php //var_dump(Yii::$app->language);die; ?>            <div class="collapse navbar-collapse navbar_mini" id="navbarNav" style="margin-right: 25px;            <?= Yii::$app->language == 'en' ? ('max-width: 622px;') : ( Yii::$app->language == 'ru' ? ('max-width: 678px;') : ('max-width:730px') ) ?>;">                <span class="div"></span>                <ul class="navbar-nav">                    <li class="nav-item dropdown about_us <?= Yii::$app->request->pathInfo == '' ||                    Yii::$app->request->pathInfo== 'site/about' || Yii::$app->request->pathInfo == 'site/chronicle' ||                    Yii::$app->request->pathInfo == 'staff' || Yii::$app->request->pathInfo == 'archive' ? 'active': ''; ?>">                        <?= Html::a(Yii::t('home', 'Գլխավոր')."<span class=\"hove_height\"></span> <i class='fas fa-angle-down fa-xs'></i>",                            'javascript:void(0)', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdownMenuLink',                                'aria-haspopup' => 'true', 'aria-expanded' => 'false']); ?>                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">                            <li>                                <?= Html::a(Yii::t('home', 'Մեր մասին'),                                    '/site/about', ['class' => 'dropdown-item']); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Տարեգրություն'),                                    '/site/chronicle', ['class' => 'dropdown-item']); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Աշխատակազմ'),                                    '/staff', ['class' => 'dropdown-item']); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Արխիվ'),                                    '/archive', ['class' => 'dropdown-item']); ?>                            </li>                        </ul>                    </li>                    <li class="nav-item <?= Yii::$app->request->pathInfo == 'staff/actor' ? 'active': ''; ?>">                        <?= Html::a(Yii::t('home', 'Դերասաններ')."<span class=\"hove_height\"></span>",                            '/staff/actor', ['class' => 'nav-link']); ?>                    </li>                    <li class="nav-item dropdown <?= Yii::$app->request->pathInfo == 'performance' || Yii::$app->request->pathInfo == 'performance/big' ||                    Yii::$app->request->pathInfo == 'performance/small' ? 'active': ''; ?>">                        <?= Html::a(Yii::t('home', 'Ներկայացումներ')."<span class=\"hove_height\"></span> <i class='fas fa-angle-down fa-xs'></i>",                            'javascript:void(0)', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdownMenuLink2',                                'aria-haspopup' => 'true', 'aria-expanded' => 'false']); ?>                        <ul class="dropdown-menu" style="left: -5px;" aria-labelledby="navbarDropdownMenuLink2">                            <li>                                <?= Html::a(Yii::t('home', 'Բոլորը'),                                    '/performance', ['class' => 'dropdown-item']); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Մեծ բեմ'),                                    '/performance/big', ['class' => 'dropdown-item']); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Փոքր թատրոն'),                                    '/performance/small', ['class' => 'dropdown-item']); ?>                            </li>                        </ul>                    </li>                    <li class="nav-item dropdown <?= Yii::$app->request->pathInfo == 'news' ? 'active': ''; ?>">                        <?= Html::a(Yii::t('home', 'Նորություններ')."<span class=\"hove_height\"></span>",                            '/news', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdownMenuLink3',                                'aria-haspopup' => 'true', 'aria-expanded' => 'false']); ?>                    </li>                    <li class="nav-item <?= Yii::$app->request->pathInfo == 'site/contact' ? 'active': ''; ?>">                        <?= Html::a(Yii::t('home', 'Կապ')."<span class=\"hove_height\"></span>",                            '/site/contact', ['class' => 'nav-link','style' => 'margin-right:0']); ?>                    </li>                </ul>                <ul class="social_icons">                    <li class="_line"></li>                    <li>                        <a id="searchBtn" data-toggle="modal" data-target="#searchModal" style="color: white">                            <i class="fas fa-search"></i>                        </a>                    </li>                    <li>                        <a href="https://www.facebook.com/gyumritheatre/" target="_blank"><i class="fab fa-facebook-f"></i></a>                    </li>                    <li>                        <a href="https://www.instagram.com/gyumri_theatre/" target="_blank"><i class="fab fa-instagram"></i></a>                    </li>                    <li>                        <a href="https://t.me/gyumri_theatre"><i class="fab fa-telegram-plane"></i></a>                    </li>                    <li class="search_icon_button">                        <!--                        <input type="text" class="form-control" placeholder="Search...">-->                    </li>                    <li>                        <?= Html::beginForm('/site/language'); ?>                        <?= Html::dropDownList('language', Yii::$app->language,                            Yii::$app->language == 'ru' ? ['am' => 'ARM', 'ru' => 'РУС', 'en' => 'ENG'] :                            ['am' => 'ՀԱՅ', 'ru' => 'РУС', 'en' => 'ENG'], [                                'class' => 'language_select',                                'onChange' => 'this.form.submit()'                            ]); ?>                        <?= Html::endForm(); ?>                    </li>                </ul>            </div>        </div>    </nav>    <div class="modal fade pr-0" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">        <div class="modal-dialog modal-dialog-centered" role="document">            <div class="modal-content" style="border: none;box-shadow: -2px 2px 23px -7px rgb(168 168 168);">                <div class="modal-header">                    <img src="/assets/images/logo.png" alt="logo">                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">                        <span aria-hidden="true">&times;</span>                    </button>                </div>                <div style="border-bottom: 3px solid #ec7532; width: 65%; margin-top: -2px;"></div>                <div class="modal-footer modal-has-search" style="border: none;">                    <form action="/site/search" method="get">                        <p class="mb-1 pl-4"><i class="fas fa-search modal-search_icon mr-1"></i><?= Yii::t('home', 'Որոնել') ?></p>                        <input value="<?= Yii::$app->request->get('search') ? Yii::$app->request->get('search') : '' ?>"                               type="text" class="modal-search_input" name="search" required>                        <div class="modal_media_btn-group">                            <input type="submit" class="btn more_btn search_button text-uppercase" value="<?= Yii::t('home', 'Որոնել') ?>">                        </div>                    </form>                </div>            </div>        </div>    </div>    <?= $content ?>    <div id="modal_popups"></div>    <footer class="footer">        <div class="container">            <div class="footer_links">                <div class="col-md-3 col-6 footer_links_items">                    <div class='footer-block1'>                        <h6 class="footer-block_title"><?= Yii::t('home', 'ԿԱՅՔԻ ՔԱՐՏԵԶ'); ?></h6>                        <ul class="footer-block_list">                            <li>                                <?= Html::a(Yii::t('home', 'Մեր մասին'),                                    '/site/about'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Տարեգրություն'),                                    '/site/chronicle'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Աշխատակազմ'),                                    '/staff'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Արխիվ'),                                    '/archive'); ?>                            </li>                        </ul>                    </div>                </div>                <div class="col-md-3 col-6 footer_links_items">                    <div class='footer-block1'>                        <h6 class="footer-block_title">&nbsp;</h6>                        <ul class="footer-block_list">                            <li>                                <?= Html::a(Yii::t('home', 'Դերասաններ'),                                    '/staff/actor'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Նորություններ'),                                    '/news'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Կապ'),                                    '/site/contact'); ?>                            </li>                        </ul>                    </div>                </div>                <div class="col-md-3 col-6 footer_links_items">                    <div class='footer-block1'>                        <h6 class="footer-block_title"><?= Yii::t('home', 'Ներկայացումներ') ?></h6>                        <ul class="footer-block_list">                            <li>                                <?= Html::a(Yii::t('home', 'Բոլորը'),                                    '/performance'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Մեծ բեմ'),                                    '/performance/big'); ?>                            </li>                            <li>                                <?= Html::a(Yii::t('home', 'Փոքր թատրոն'),                                    '/performance/small'); ?>                            </li>                        </ul>                    </div>                </div>                <div class="col-md-3 col-6 footer_links_items">                    <div class='footer-block4'>                        <h6 class="footer-block_title"><?= Yii::t('home', 'ԿԱՊՆՎԵՔ ՄԵԶ ՀԵՏ'); ?></h6>                        <ul class="footer-block_list">                            <li><a href="https://www.facebook.com/gyumritheatre/" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>                            <li><a href="https://www.instagram.com/gyumri_theatre/" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>                            <li><a href="https://t.me/gyumri_theatre" target="_blank"><i class="fab fa-telegram"></i> Telegram</a></li>                        </ul>                    </div>                </div>            </div>        </div>    </footer>    <div class='footer_year'>        <div class="container">            <p class="pt-4 pb-1 m-0 pb-4" style="font-family: sans-serif"><?= date('Y'); ?> Gyumrytheatre &nbsp;|&nbsp; <a href="https://brainfors.com" style="font-family: sans-serif;color: #505051;" target="_blank">© Brainfors</a></p>        </div>    </div></div><?php Performance::openModal(); ?><?php $this->endBody() ?><script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHgRUArUzZIqBgtywpYk2Fcybbh7HtSz0&callback=initMap"></script><!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--><script src="/assets/js/flexible.pagination.js"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script><script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><script src="/assets/libs/owlcarousel/owl.carousel.min.js"></script><script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"        integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw=="        crossorigin="anonymous"></script><script src="/assets/libs/fontawesome-free-5.13.1-web/js/all.js"></script><script src='/assets/js/script.js'></script><!-- Facebook Pixel Code --><script>    !function(f,b,e,v,n,t,s)    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?        n.callMethod.apply(n,arguments):n.queue.push(arguments)};        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';        n.queue=[];t=b.createElement(e);t.async=!0;        t.src=v;s=b.getElementsByTagName(e)[0];        s.parentNode.insertBefore(t,s)}(window, document,'script',        'https://connect.facebook.net/en_US/fbevents.js');    fbq('init', '2224980997639496');    fbq('track', 'PageView');</script><noscript><img height="1" width="1" style="display:none"               src="https://www.facebook.com/tr?id=2224980997639496&ev=PageView&noscript=1"    /></noscript><!-- End Facebook Pixel Code --><!--https://developers.facebook.com/docs/facebook-pixel/implementation/conversion-tracking/--></body></html><?php $this->endPage() ?>