
<?php

use common\models\GenrePerformance;
use common\models\Performance;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>


<div id="hero" class="carousel slide carousel-fade" data-ride="carousel">
    <img src="/assets/images/Group 7.svg" alt="Scroll down" class="scroll">
    <div class="scrollme">
        <h1 class="baner_title"><?= Yii::t('home', 'Գյումրու Դրամատիկական թատրոն') ?></h1>
    </div>
    <div class="header_carousel owl-carousel" id="headerCarousel">

        <div class="carusel_block">
            <img src="/assets/images/baner.png" alt="Photo">
        </div>

        <div class="carusel_block">
            <img src="/assets/images/baner_gray.jpg" alt="Photo">
        </div>

        <div class="carusel_block">
            <img src="/assets/images/baner.png" alt="Photo">
        </div>

    </div>

    <!-- <ol class="carousel-indicators">
        <li data-target="#hero" data-slide-to="0"></li>
        <li data-target="#hero" data-slide-to="1" class="active"></li>
        <li data-target="#hero" data-slide-to="2"></li>
        <li data-target="#hero" data-slide-to="3"></li>
    </ol>

    <div class="carousel-inner">
        <div class="item active" style="background-image: url(images/baner.png)">
        </div>
    </div> -->
</div>

<section class="section_carousel">
    <div class="container mt-5">
        <div class="current_performances">
            <h2 class="block_title carousel_title mt-3 contact_block_title"><?= Yii::t('home', 'Ընթացիկ ներկայացումներ') ?></h2>
            <div class="block_title_gred_line"></div>
        </div>
        <span class="title_line" style="margin-top: -25px;"></span>
        <div class="main_carousel owl-carousel" id="current_performance">
        <?php if (!empty($performances) && isset($performances)): ?>
            <?php foreach ($performances as $item): ?>
            <div class="carousel_item">
                <div class="card" style="width: 16rem;">
                    <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                        <img class="big-carousel card-img-top" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$item->img_path; ?>" alt="image">
                    </a>
                    <div class="card-body">
                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                            <h5 class="card-title"><?= Yii::t('text', $item->title); ?></h5>
                        </a>
                        <p class="card-text"><?= Performance::getPerformanceTime($item->show_date); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>

    </div>

</section>

<main class="main_movies mb-5 pt-2" style="background: white;">
    <div class="container main_container" style="margin-bottom: -50px;">
        <nav>
            <div class="nav nav-tabs weekdays_all" id="nav-tab" role="tablist">
                <!-- <input id="datepicker"  class="date-calendar" type="text"> -->
                <a class="nav-item nav-link weekdays calendar_icon active" data-value="all" id="nav-cal-tab" data-toggle="tab" href="#nav-cal" role="tab"
                   aria-controls="nav-cal" aria-selected="true"><img style="width: 26px;" src="<?= Yii::$app->params['frontend-url'].'/assets/images/Векторный смарт-объект.svg'?>" alt=""></a>
                <a class="nav-item nav-link weekdays" data-id="2" id="nav-tus-tab" data-toggle="tab" href="#nav-tus" role="tab"
                   aria-controls="nav-tus" aria-selected="true"><?= Yii::t('home', 'ԵՐՔ') ?></a>
                <a class="nav-item nav-link weekdays" data-id="3" id="nav-wed-tab" data-toggle="tab" href="#nav-wed" role="tab"
                   aria-controls="nav-wed" aria-selected="false"><?= Yii::t('home', 'ՉՐՔ') ?></a>
                <a class="nav-item nav-link weekdays" data-id="4" id="nav-thur-tab" data-toggle="tab" href="#nav-thur" role="tab"
                   aria-controls="nav-thur" aria-selected="false"><?= Yii::t('home', 'ՀՆԳ') ?></a>
                <a class="nav-item nav-link weekdays" data-id="5" id="nav-fri-tab" data-toggle="tab" href="#nav-fri" role="tab"
                   aria-controls="nav-fri" aria-selected="false"><?= Yii::t('home', 'ՈՒՐԲ') ?></a>
                <a class="nav-item nav-link weekdays" data-id="6" id="nav-sat-tab" data-toggle="tab" href="#nav-sat" role="tab"
                   aria-controls="nav-sat" aria-selected="false"><?= Yii::t('home', 'ՇԲԹ') ?></a>
                <a class="nav-item nav-link weekdays" data-id="0" id="nav-sun-tab" data-toggle="tab" href="#nav-sun" role="tab"
                   aria-controls="nav-sun" aria-selected="false"><?= Yii::t('home', 'ԿԻՐ') ?></a>
            </div>
        </nav>
        <div class="tab-content pb-3" id="nav-tabContent" style="min-height: 330px"></div>

    </div>

</main>

<section class="new_section p-2" style="min-height: 510px; background-image: linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7) ), url(<?= Yii::$app->params['backend-url'].'/upload/banners/'.$performanceSoon->banner; ?>);">
    <div class="container" style="padding: 0 30px;">
        <h2 class="new_section-title mb-0" style="border-bottom: 1px solid #202020;padding-bottom: 10px;"><?= Yii::t('home', 'ԱՆՈՆՍ') ?></h2>
        <div class="block_title_gred_line m-0 mb-2" style="width: 115px;"></div>
        <div class="row" style="margin-top: 65px;">
            <div class="col-md-7 boredr">
                <div class="media-body">
                    <h5 class="mt-0 media-title" style="font-family: 'Arm Hmks';"><?= Yii::t('text', $performanceSoon->title); ?></h5>
                    <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $performanceSoon->id])->asArray()->all();
                    $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                    <small class="movie-type" style="font-family: sans-serif;">
                        <?php $str = '';
                        foreach ($genre as $item){
                            $str .= ' '.Yii::t('text', $item).',';
                        }
                        echo trim($str, ','); ?>
                    </small>
                    <p class="author" style="font-family: sans-serif;"><?= Yii::t('text', $performanceSoon->author); ?></p>
                    <p class="media-text" style="margin: 0 30px 0px 0px;">
                        <?= mb_substr(Yii::t('text', $performanceSoon->short_desc),0,190, 'utf-8'); ?>
                        <?= strlen(Yii::t('text', $performanceSoon->short_desc)) > 190 ? '...' : ''; ?>
                    </p>

                    <div class="media-footer my-media-footer" style="margin-top: 25px;">
                        <div class="media_btn-group">
                            <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performanceSoon->slug)]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                        </div>
                        <div class="d-flex">
                            <span class="calendar"><i class="far fa-calendar-alt"></i></span>
                            <p class='view-movie'><?= Performance::getPerformanceTime($performanceSoon->show_date); ?></p>
                        </div>

                    </div>
                </div>
            </div>

            <?php if (!empty($performanceSoon->trailer) && isset($performanceSoon->trailer)): ?>
                <div class="col-md-5 position-relative site-index-contnet" style="margin-top: 15px;margin-left: -15px; background-image: linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7) ), url(<?= Yii::$app->params['backend-url'].'/upload/banners/'.$performanceSoon->banner; ?>);background-size: cover;">
                    <span class="btn_play about_popup_youtube site-index-trailer">
                        <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $performanceSoon->trailer; ?>">
                            <i class="fas fa-play" style="font-size: 24px"></i>
                        </a>
                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="about-carousel" style="transform: translateY(30px);">
    <div class="container">

        <div class="main_carousel owl-carousel" id="performances-carusel">
<!--            --><?php //$performances = Performance::find()->orderBy(['id' => SORT_DESC])->limit(6)->all(); ?>
            <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                    <div class="carousel_item">
                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                            <div class="card">
                                <img class="card-img-top" style="height: 275px; max-width: 200px; object-fit: cover;margin: 0px 15px;" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item->img_path; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= Yii::t('text', $item->title); ?></h5>
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
<article class="article-call">
    <p class="number-text"><?= Yii::t('home', 'ՏԵՂԵԿԱՏՈՒ ՀԵՌԱԽՈՍԱՀԱՄԱՐ') ?></p>
    <h5 class="call-number">060 96 10 10</h5>
</article>