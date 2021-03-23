<?php

use common\models\GenrePerformance;
use common\models\Image;
use common\models\Performance;
use frontend\controllers\TicketController;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<div class="performances-page">

    <div id="hero" class="carousel slide carousel-fade performance_header <?= $model->mobile_banner ? 'big_background' : '' ?>" data-ride="carousel"
         style="position: relative;background: url(<?= Yii::$app->params['backend-url'].'/upload/banners/'.$model->banner; ?>) no-repeat center;"></div>
    <?php if ($model->mobile_banner) : ?>
    <div id="hero" class="carousel slide carousel-fade performance_header small_background" data-ride="carousel"
         style="position: relative;background: url(<?= Yii::$app->params['backend-url'].'/upload/mobile_banners/'.$model->mobile_banner; ?>)
         no-repeat center;background-size: cover;min-height: 0;height: 30vh;margin-top: 70px;"></div>
    <?php endif; ?>

    <div class="container main_container">

        <section class="about-present main_movies">
            <div class="media">
                <div class="row">
                    <div class="col-md-4  col-12 view_img_content">
                        <img style="max-width: 96%;width: 96%;height: auto;object-fit: cover;border-radius: unset;" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$model->img_path; ?>" alt="Photo">
                    </div>
                    <div class="col-md-8 col-12 view_text_content">

                        <div class="media-body" style="position: relative">
                            <p class="author"><?= Yii::t('text', $model->author); ?> </p>
                            <h1 class="mt-0 media-title" style="max-width: 100%;"><?= Yii::t('text', $model->title); ?></h1>
                            <?php if (!empty($model->trailer) && isset($model->trailer)): ?>
                                <span class="btn_play about_popup_youtube"><a target="_blank" class="popup_youtube"
                                                                              href="https://www.youtube.com/watch?v=<?= $model->trailer; ?>"><i
                                                class="fas fa-play"></i></a></span>
                            <?php endif; ?>
                            <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $model->id])->asArray()->all();
                            $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                            <small class="movie-type" style="margin-top: 8px;">
                                <?php $str = '';
                                foreach ($genre as $item){
                                    $str .= ' '.Yii::t('text', $item).',';
                                }
                                echo trim($str, ','); ?>
                            </small>
                            <p class="media-text"><?= Yii::t('text', $model->desc); ?></p>

                            <div class="media-footer">
                                <?php if ($model->external_id) : ?>
                                <div class="media_btn-group">
                                    <div id="orderingBtn" data-toggle="modal" data-target="#orderingModal" style="color: white">
                                        <button class="btn more_btn showModalOrdering" data-id="<?=$model->external_id?>"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?></button>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <p class="movie-lenght">
                                    <?php if (!empty($model->performance_length) && isset($model->performance_length)) : ?>
                                    <?= $model->performance_length; ?> <?= Yii::t('home', 'ՐՈՊԵ') ?>
                                    <?php endif; ?>
                                    <?php if (!empty($model->age_restriction) && isset($model->age_restriction)) : ?>
                                    <span ><?= $model->age_restriction; ?>+</span
                                    <?php endif; ?>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>


    <?php $images = Image::find()->where(['performance_id' => $model->id])->all(); ?>
    <?php if (!empty($images) && isset($images)): ?>
    <section class="present-corusel" >
        <div class="container page_images_carousel">
            <div class="current_performances" style="margin: 0 auto;">
                <h2 class="block_title carousel_title mt-0 contact_block_title"><?= Yii::t('home', 'ԼՈՒՍԱՆԿԱՐՆԵՐ') ?></h2>
                <div class="block_title_gred_line"></div>
            </div>
            <span class="title_line"></span>
            <div class="performances-carusel owl-carousel" id="current_performance">
                <?php foreach ($images as $image): ?>
                <div class="block-present carusel_block">
                    <a href="<?= Yii::$app->params['backend-url'].'/upload/galleries/original/'.$image->image; ?>">
                        <img src="<?= Yii::$app->params['backend-url'].'/upload/galleries/250/'.$image->image; ?>" alt="Photo">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="new_section p-2" style="min-height: 580px; background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?= Yii::$app->params['backend-url'].'/upload/banners/'.$model->banner; ?>);">
        <div class="container" style="padding: 0 30px;">
            <h2 class="new_section-title mb-0" style="border-bottom: 1px solid #202020;padding-bottom: 10px;"><?= Yii::t('home', 'ԱՆՈՆՍ') ?></h2>
            <div class="block_title_gred_line m-0 mb-2" style="width: 115px;"></div>
            <div class="row" style="margin-top: 65px;">
                <div class="col-md-7 boredr">
                    <div class="media-body">
                        <h5 class="mt-0 media-title" style="font-family: 'Arm Hmks';">
                            <?= mb_substr(Yii::t('text', $model->title),0,25, 'utf-8'); ?>
                            <?= strlen(Yii::t('text', $model->title)) > 25 ? '...' : ''; ?>
                        </h5>

                        <p class="media-text" style="margin: 0 30px 0px 0px;">
                            <?= mb_substr(Yii::t('text', $model->short_desc),0,250, 'utf-8'); ?>
                            <?= strlen(Yii::t('text', $model->short_desc)) > 250 ? '...' : ''; ?>
                        </p>

                        <div class="media-footer" style="margin-top: 25px; display: block">
                            <div class="d-flex mb-2">
                                <span class="calendar ml-0 mr-2 text-white"><i class="far fa-calendar-alt"></i></span>
                                <p class='view-movie' style="margin-top: -4px;"><?= Performance::getPerformanceTime($model->show_date); ?></p>
                            </div>
                            <?php if ($model->external_id) : ?>
                            <div class="media_btn-group">
                                <div class="" id="orderingBtn" data-toggle="modal" data-target="#orderingModal" style="color: white">
                                    <button class="btn more_btn showModalOrdering" data-id="<?=$model->external_id?>"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?></button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($model->trailer) && isset($model->trailer)): ?>
                    <div class="col-md-5 position-relative banner_perform" style="margin-top: 15px;margin-left: -15px; background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?= Yii::$app->params['backend-url'].'/upload/mobile_banners/'.$model->mobile_banner; ?>);background-size: cover;">
                        <span class="btn_play about_popup_youtube site-index-trailer">
                            <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $model->trailer; ?>"><i class="fas fa-play" style="font-size: 23px"></i></a>
                        </span>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>


    <article class="article-call">
        <p class="number-text"><?= Yii::t('home', 'ՏԵՂԵԿԱՏՈՒ ՀԵՌԱԽՈՍԱՀԱՄԱՐ') ?></p>
        <h5 class="call-number">060 96 10 10</h5>
    </article>


</div>
<section class="about-carousel" style="transform: translateY(30px);">
    <div class="container">

        <div class="main_carousel owl-carousel" id="performances-carusel">
            <?php $performances = Performance::find()->orderBy(['id' => SORT_DESC])->limit(6)->all(); ?>
            <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                    <div class="carousel_item">
                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                            <div class="card">
                                <img class="card-img-top" style="height: 275px; max-width: 200px; object-fit: cover;margin: 0px 15px;" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$item->img_path; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= Yii::t('text', $item->title); ?></h5>
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