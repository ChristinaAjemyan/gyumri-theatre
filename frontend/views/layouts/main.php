<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Performance;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Գյումրու Վարդան Աճեմյանի անվան պետական դրամատիկական թատրոն (նախկինում՝ Ասքանազ Մռավյանի անվան, մինչև 1938 թ.-ը կոչվել է նաև Երկրորդ պետթատրոն), հիմնադրվել է 1928 թվականին, բացվել նոյեմբերի 1-ին «Խռովություն» ներկայացումով">
    <meta name="keywords" content="Երկնագույն շան աչքերը, Հարսանիք թիկունքում, Harsaniq tikunqum,Գյումրու պետական դրամատիկական թատրոն ,Ոչինչ Չի Մնա ,Vochinch chi mna">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/assets/images/logo.png" />
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
          integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
          crossorigin="anonymous">
</head>

<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-pages">
        <div class="container header_flex">

            <?= Html::a(Html::img(Url::to('/assets/images/logo.png')),  Yii::$app->params['front-url'], ['class' => 'navbar-brand logo']); ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i></i>
						<i></i>
						<i></i>
					</span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <span class="div"></span>
                <ul class="navbar-nav">

                    <li class="nav-item dropdown about_us <?= Yii::$app->request->pathInfo == '' ? 'active': ''; ?>">
                        <?= Html::a(Yii::t('home', 'ՄԵՐ մԱՍԻՆ')."<span class=\"hove_height\"></span>",
                            '', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdownMenuLink',
                                'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']); ?>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <?= Html::a(Yii::t('home', 'Տարեգրություն'),
                                    '', ['class' => 'dropdown-item']); ?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('home', 'Վարչական մաս'),
                                    '', ['class' => 'dropdown-item']); ?>
                            </li>
                            <li>
                                <?= Html::a(Yii::t('home', 'Արխիվ'),
                                    '', ['class' => 'dropdown-item']); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= Yii::$app->request->pathInfo == 'staff' ? 'active': ''; ?>">
                        <?= Html::a(Yii::t('home', 'ԴԵՐԱՍԱՆՆԵՐ')."<span class=\"hove_height\"></span>",
                            '/staff', ['class' => 'nav-link']); ?>
                    </li>
                    <li class="nav-item dropdown">
                        <?= Html::a(Yii::t('home', 'ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ')."<span class=\"hove_height\"></span>",
                            '', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdownMenuLink2',
                                'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']); ?>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <li>
                                <?= Html::a(Yii::t('home', 'ՓՈՔՐ ԹԱՏՐՈՆ'),
                                    '', ['class' => 'dropdown-item']); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <?= Html::a(Yii::t('home', 'ՆՈՐՈՒԹՅՈՒՆՆԵՐ')."<span class=\"hove_height\"></span>",
                            '', ['class' => 'nav-link dropdown-toggle', 'id' => 'navbarDropdownMenuLink3',
                                'data-toggle' => 'dropdown', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']); ?>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
                            <li>
                                <?= Html::a(Yii::t('home', 'ԼՐԱՏՎԱՄԻՋՈՑ'),
                                    '', ['class' => 'dropdown-item']); ?>
                            </li>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <?= Html::a(Yii::t('home', 'ԿԱՊ')."<span class=\"hove_height\"></span>",
                            '', ['class' => 'nav-link']); ?>
                    </li>
                </ul>
                <ul class="social_icons">
                    <li class="_line"></li>
                    <li>
                        <a id="searchBtn"><i class="fas fa-search"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-telegram-plane"></i></a>
                    </li>
                    <li class="search_input"><input type="text" class="form-control" placeholder="Search..."></li>
                    <li>
<!--                        <select name="languaga" class="language_select">
                            <option value="am">Հայ</option>
                            <option value="ru">Рус</option>
                            <option value="en">Eng</option>
                        </select>-->
                        <?= Html::beginForm('/site/language'); ?>
                        <?= Html::dropDownList('language', Yii::$app->language,
                            ['am-AM' => 'Հայ', 'ru-RU' => 'Рус', 'en-EN' => 'Eng'], [
                                    'class' => 'language_select',
                                'onChange' => 'this.form.submit()'
                            ]); ?>
                        <?= Html::endForm(); ?>
                    </li>
                </ul>

            </div>

        </div>


    </nav>

    <?= $content ?>

    <?php if (Yii::$app->request->pathInfo !== 'site/about'): ?>
    <section class="about-carousel" style="transform: translateY(30px);">
        <div class="container">

            <div class="main_carousel owl-carousel" id="performances-carusel">
                <?php $performances = Performance::find()->orderBy(['id' => SORT_DESC])->limit(6)->all(); ?>
                <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                <div class="carousel_item">
                    <a href="/performance/view?id=<?= $item->id; ?>">
                        <div class="card">
                            <img class="card-img-top" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item->img_path; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $item->title; ?></h5>
                                <p class="card-text"><?= Performance::getPerformanceTime($item->show_date); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <hr class="foote-and-carusel">
        </div>

    </section>
    <?php endif; ?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class='footer-block1'>
                        <h6 class="footer-block_title">GET IN TOUCH</h6>
                        <ul class="footer-block_list">
                            <li> <a href="#">FAQs </a></li>
                            <li> <a href="#">Give us feedback</a></li>
                            <li> <a href="#">Contact us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class='footer-block2'>
                        <h6 class="footer-block_title">ABOUT MOVIE STAR</h6>
                        <ul class="footer-block_list">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Find us</a></li>
                            <li><a href="#">Schedule</a></li>
                            <li><a href="#">News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class='footer-block3'>
                        <h6 class="footer-block_title">LEGAL STUFF</h6>
                        <ul class="footer-block_list">
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy policy</a></li>
                            <li><a href="#">Cookie policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class='footer-block4'>
                        <h6 class="footer-block_title">CONNECT WITH US</h6>
                        <ul class="footer-block_list">
                            <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i> Google +</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <div class='footer_year'>
        <div class="container">
            <p>2020 GYUMRITHEATRE</p>
        </div>

    </div>
</div>


    <?php $this->endBody() ?>
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>-->
<script src="/assets/js/flexible.pagination.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="/assets/libs/owlcarousel/owl.carousel.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"
        integrity="sha512-C1zvdb9R55RAkl6xCLTPt+Wmcz6s+ccOvcr6G57lbm8M2fbgn2SUjUJbQ13fEyjuLViwe97uJvwa1EUf4F1Akw=="
        crossorigin="anonymous"></script>

<script src="/assets/libs/fontawesome-free-5.13.1-web/js/all.js"></script>

<script src='/assets/js/script.js'></script>
</body>

</html>
<?php $this->endPage() ?>
