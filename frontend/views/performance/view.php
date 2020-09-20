<?php

use common\models\GenrePerformance;
use common\models\Image;
use common\models\Performance;
use yii\helpers\ArrayHelper;

?>

<div class="performances-page">

    <div id="hero" class="carousel slide carousel-fade performance_header" data-ride="carousel"
         style="background: url(<?= Yii::$app->params['backend-url'].'/upload/banners/'.$model->banner; ?>) no-repeat center;">
        <span class="btn_play"><a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $model->trailer; ?>"><i class="fas fa-play"></i></a></span>
        <div class="carousel-inners" >
            <!-- <iframe src="https://www.youtube.com/embed/uqA-tT3T6FQ"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe> -->

            <!-- item 2 -->

        </div>

    </div>


    <div class="container">

        <section class="about-present main_movies">
            <div class="media">
                <div class="row">
                    <div class="col-md-3  col-12">
                        <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$model->img_path; ?>" alt="Photo">
                    </div>
                    <div class="col-md-9 col-12">

                        <div class="media-body">
                            <p class="author"><?= $model->author; ?> </p>
                            <h1 class="mt-0 media-title"><?= $model->title; ?></h1>
                            <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $model->id])->asArray()->all();
                            $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                            <small class="movie-type">
                                <?php $str = '';
                                foreach ($genre as $item){
                                    $str .= ' '.$item.',';
                                }
                                echo trim($str, ','); ?>
                            </small>
                            <p class="media-text"><?= $model->desc; ?></p>

                            <div class="media-footer">
                                <div class="media_btn-group">
                                    <button class="btn more_btn">ՊԱՏԻՎԻՐԵԼ
                                        <i class="fas fa-chevron-right"></i></button>
                                </div>
                                <p class='view-movie'><i class="far fa-calendar-alt"></i><?= Performance::getPerformanceTime($model->show_date); ?></p>
                                <p class="movie-lenght"><?= $model->performance_length; ?> ՐՈՊԵ<span><?= $model->age_restriction; ?>+</span></p>
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
        <div class="container">
            <h2 class="block_title carousel_title">ԼՈՒՍԱՆԿԱՐՆԵՐ</h2>
            <span class="title_line"></span>
            <div class="performances-carusel owl-carousel" id="current_performance">
                <?php foreach ($images as $image): ?>
                <div class="block-present">
                    <a href="<?= Yii::$app->params['backend-url'].'/upload/galleries/original/'.$image->image; ?>">
                        <img src="<?= Yii::$app->params['backend-url'].'/upload/galleries/250/'.$image->image; ?>" alt="Photo">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="new_section p-2" style="background-image: url(<?= Yii::$app->params['backend-url'].'/upload/banners/'.$model->banner; ?>);">
        <div class="container ">
            <h3 class="new_section-title">ԱՆՈՆՍ</h3>
            <div class="row">
                <div class="col-md-7 boredr">
                    <div class="media-body">
                        <h5 class="mt-0 media-title"><?= $model->title; ?></h5>
                        <p class="media-text"><?= $model->short_desc; ?></p>

                        <div class="media-footer">
                            <div class="media_btn-group">
                                <div class="calendar-block">
                                    <span class="calendar"><i class="far fa-calendar-alt"></i></span>
                                    <p class='view-movie'><?= Performance::getPerformanceTime($model->show_date); ?></p>
                                </div>

                                <button class="btn more_btn">ՊԱՏԻՎԻՐԵԼ
                                    <i class="fas fa-chevron-right"></i></button>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="video_block">

                        <iframe width="460" height="315" src="https://www.youtube.com/embed/<?= $model->trailer; ?>"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <article class="article-call">
        <p class="number-text">ՏԵՂԵԿԱՏՈՒ ՀԵՌԱԽՈՍԱՀԱՄԱՐ</p>
        <h5 class="call-number">060 96 10 10</h5>
    </article>


</div>