
<?php

use common\models\GenrePerformance;
use common\models\Performance;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>


<div id="hero" class="carousel slide carousel-fade" data-ride="carousel">
    <img src="/assets/images/scroll-arrow.svg" alt="Scroll down" class="scroll">
    <div class="scrollme">
        <h1 class="baner_title"><?= Yii::t('home', 'Գյումրու Դրամատիկական թատրոն') ?></h1>
    </div>
    <div class="header_carousel owl-carousel" id="headerCarousel">

        <div class="carusel_block">
            <img src="/assets/images/baner.png" alt="Photo">
        </div>

        <div class="carusel_block">
            <img src="/assets/images/baner.png" alt="Photo">
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
    <div class="container">
        <h2 class="block_title carousel_title"><?= Yii::t('home', 'Ընթացիկ ներկայացումներ') ?></h2>
        <span class="title_line"></span>
        <div class="main_carousel owl-carousel" id="current_performance">
        <?php if (!empty($performances) && isset($performances)): ?>
            <?php foreach ($performances as $item): ?>
            <div class="carousel_item">
                <div class="card" style="width: 16rem;">
                    <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                        <img class="card-img-top" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$item->img_path; ?>" alt="image">
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

<main class="main_movies mb-5">
    <div class="container p-3">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- <input id="datepicker"  class="date-calendar" type="text"> -->
                <a class="nav-item nav-link weekdays active" data-value="all" id="nav-cal-tab" data-toggle="tab" href="#nav-cal" role="tab"
                   aria-controls="nav-cal" aria-selected="true"><i class="far fa-calendar-alt"></i></a>
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
        <div class="tab-content" id="nav-tabContent"></div>

    </div>

</main>

<section class="new_section p-2">
    <div class="container ">
        <h3 class="new_section-title"><?= Yii::t('home', 'ՇՈՒՏՈՎ') ?></h3>
        <div class="row">
            <div class="col-md-7 boredr">
                <div class="media-body">
                    <h5 class="mt-0 media-title"><?= Yii::t('text', $performanceSoon->title); ?></h5>
                    <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $performanceSoon->id])->asArray()->all();
                    $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                    <small class="movie-type">
                        <?php $str = '';
                        foreach ($genre as $item){
                            $str .= ' '.Yii::t('text', $item).',';
                        }
                        echo trim($str, ','); ?>
                    </small>
                    <p class="author"><?= Yii::t('text', $performanceSoon->author); ?></p>
                    <p class="media-text">
                        <?= mb_substr(Yii::t('text', $performanceSoon->desc),0,190, 'utf-8'); ?>
                        <?= strlen(Yii::t('text', $performanceSoon->desc)) > 190 ? '...' : ''; ?>
                    </p>

                    <div class="media-footer">
                        <div class="media_btn-group">
                            <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performanceSoon->slug)]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                        </div>
                        <span class="calendar"><i class="far fa-calendar-alt"></i></span>
                        <p class='view-movie'><?= Performance::getPerformanceTime($performanceSoon->show_date); ?></p>

                    </div>
                </div>
            </div>


            <div class="col-md-5">
                <div class="video_block">

                    <iframe width="460" height="315" src="https://www.youtube.com/embed/<?= $performanceSoon->trailer; ?>"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<article class="article-call">
    <p class="number-text"><?= Yii::t('home', 'ՏԵՂԵԿԱՏՈՒ ՀԵՌԱԽՈՍԱՀԱՄԱՐ') ?></p>
    <h5 class="call-number">060 96 10 10</h5>
</article>
