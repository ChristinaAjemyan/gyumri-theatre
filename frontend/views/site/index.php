
<div id="hero" class="carousel slide carousel-fade" data-ride="carousel">
    <img src="/assets/images/scroll-arrow.svg" alt="Scroll down" class="scroll">
    <div class="scrollme">
        <h1 class="baner_title">ԳՅՈՒՄՐՈՒ ԴՐԱՄԱՏԻԿԱԿԱՆ ԹԱՏՐՈՆ</h1>
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


<?php

use common\models\Genre;
use common\models\GenrePerformance;
use common\models\Performance;
use yii\helpers\ArrayHelper;

/*echo '<pre>';
var_dump($performanceAll);
echo '</pre>';*/

$a = '2020-09-23 19:40:00';

//echo  date("w");
//echo  date("W");
//$date = date("w", '2020-09-27 09:24:00');
//echo $date;

/*$startDate = date('Y-m-d', strtotime("last Tuesday"));
$endDate = date('Y-m-d', strtotime("Monday"));
foreach ($performanceAll as $item){
    if ($item->show_date > $startDate && $item->show_date < $endDate){
        var_dump($item->show_date);
    }
}*/
//var_dump($startDate.'- '.$endDate);


?>
<section class="section_carousel">
    <div class="container">
        <h2 class="block_title carousel_title">ԸՆԹԱՑԻԿ ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ</h2>
        <span class="title_line"></span>
        <div class="main_carousel owl-carousel" id="current_performance">
        <?php if (!empty($performances) && isset($performances)): ?>
            <?php foreach ($performances as $item): ?>
            <div class="carousel_item">
                <div class="card" style="width: 16rem;">
                    <a href="/performance/view?id=<?= $item->id; ?>">
                        <img class="card-img-top" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$item->img_path; ?>" alt="image">
                    </a>
                    <div class="card-body">
                        <a href="/performance/view?id=<?= $item->id; ?>">
                            <h5 class="card-title"><?= $item->title; ?></h5>
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
                <a class="nav-item nav-link active" id="nav-cal-tab" data-toggle="tab" href="#nav-cal" role="tab"
                   aria-controls="nav-cal" aria-selected="true"><i class="far fa-calendar-alt"></i></a>

                <a class="nav-item nav-link" id="nav-tus-tab" data-toggle="tab" href="#nav-tus" role="tab"
                   aria-controls="nav-tus" aria-selected="true">ԵՐՔ</a>
                <a class="nav-item nav-link" id="nav-wed-tab" data-toggle="tab" href="#nav-wed" role="tab"
                   aria-controls="nav-wed" aria-selected="false">ՉՐՔ</a>
                <a class="nav-item nav-link" id="nav-thur-tab" data-toggle="tab" href="#nav-thur" role="tab"
                   aria-controls="nav-thur" aria-selected="false">ՀՆԳ</a>
                <a class="nav-item nav-link" id="nav-fri-tab" data-toggle="tab" href="#nav-fri" role="tab"
                   aria-controls="nav-fri" aria-selected="false">ՈՒՐԲ</a>
                <a class="nav-item nav-link" id="nav-sat-tab" data-toggle="tab" href="#nav-sat" role="tab"
                   aria-controls="nav-sat" aria-selected="false">ՇԲԹ</a>
                <a class="nav-item nav-link" id="nav-sun-tab" data-toggle="tab" href="#nav-sun" role="tab"
                   aria-controls="nav-sun" aria-selected="false">ԿԻՐ</a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-cal" role="tabpanel" aria-labelledby="nav-cal-tab">
                <?php if (!empty($performanceAll) && isset($performanceAll)): ?>
                <?php foreach ($performanceAll as $item): ?>
                <div class="media">
                    <div class="row">
                        <div class="col-md-3  col-12">
                            <a href="/performance/view?id=<?= $item->id; ?>">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item->img_path; ?>" class="mr-5" alt="Photo">
                            </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body">
                                <?php if ($item->hall == 1): ?>
                                    <aside class="aside_text aside-text_bg">ՓՈՔՐ ԹԱՏՐՈՆ</aside>
                                <?php elseif ($item->hall == 2): ?>
                                    <aside class="aside_text">ՀՅՈՒՐԱԽԱՂ</aside>
                                <?php endif; ?>
                                <p class="author"><?= $item->author; ?> </p>
                                <a href="/performance/view?id=<?= $item->id; ?>"><h5 class="mt-0 media-title"><?= $item->title; ?></h5></a>
                                <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $item->id])->asArray()->all();
                                $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                                <small class="movie-type">
                                    <?php $str = '';
                                    foreach ($genre as $value){
                                        $str .= ' '.$value.',';
                                    }
                                    echo trim($str, ','); ?>
                                </small>
                                <p class="media-text">
                                    <?= substr($item->desc,0,571); ?>
                                    <?= strlen($item->desc) > 571 ? '...' : ''; ?></p>
                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="/performance/view?id=<?= $item->id; ?>" class="btn more_btn">ԱՎԵԼԻՆ</a>
                                        <?php if ($item->show_date > date("Y-m-d H:i:s")): ?>
                                        <button class="btn add_cupon">ՊԱՏԻՎԻՐԵԼ
                                            <i class="fas fa-chevron-right"></i></button>
                                        <?php endif; ?>
                                    </div>
                                    <p class='view-movie'><?= Performance::getPerformanceTime($item->show_date); ?></p>
                                    <p class="movie-lenght"><?= $item->performance_length; ?> ՐՈՊԵ<span><?= $item->age_restriction; ?>+</span></p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <?php endforeach; ?>
                <?php else: ?>
                    <?= "<p class='text-center h2'>Ներկայացում չի գտնվել</p>"; ?>
                <?php endif; ?>
            </div>

            <?php
            $arrHref = [0 => 'nav-sun', 2=> 'nav-tus', 3 => 'nav-wed', 4 => 'nav-thur', 5 => 'nav-fri', 6 => 'nav-sat'];
            $arrID = [0 => 'nav-sun-tab', 2=> 'nav-tus-tab', 3 => 'nav-wed-tab', 4 => 'nav-thur-tab', 5 => 'nav-fri-tab', 6 => 'nav-sat-tab'];
            $startDate = date('Y-m-d', strtotime("last Tuesday"));
            $endDate = date('Y-m-d', strtotime("Monday"));
            $date = date("w", mktime(0, 0, 0, 9, 27, 20));
            foreach ($performanceAll as $item){
                if ($item->show_date > $startDate && $item->show_date < $endDate){?>
                    <?php

                    if ($item->show_date == '2020-09-27 09:24:00'){?>

                        <div class="tab-pane fade" id="<?= $arrHref[$date]; ?>" role="tabpanel" aria-labelledby="<?= $arrID[$date]; ?>">
                            <?php var_dump($item->author); ?>
                        </div>


                        <?php
                    }

                    ?>

                   <?php
                }
            }


            ?>



<!--            <div class="tab-pane fade" id="nav-tus" role="tabpanel" aria-labelledby="nav-tus-tab">
                <div class="media color_h">
                    <div class="row">
                        <div class="col-md-3 col-12">

                            <img src="/assets/images/item_img1.png" class="mr-5" alt="Photo">
                        </div>
                        <div class="col-md-9 col-12">

                            <div class="media-body">
                                <p class="author">ԳԱԲՐԻԵԼ ԳԱՐՍԻԱ ՄԱՐԿԵՍ </p>
                                <h5 class="mt-0 media-title">Ոչինչ չի մնա</h5>
                                <small class="movie-type">դրամա</small>
                                <p class="media-text">Ակնդետ ինձ էր նայում։ Ոչ մի կերպ չէի հասկանում՝ որտե՞ղ եմ
                                    տեսել։ Խոնավ, տագնապած
                                    հայացքը փայլկտաց նավթալամպի ընդհատուն լույսի մեջ։ Հիշեցի, ամեն գիշեր երազում այս
                                    սենյակն ու այս լամպն եմ տեսնում եւ տագնապած հայացքով այս աղջկան։ Այո, այո, ամեն
                                    անգամ, երբ հատում եմ երազատեսության երերուն սահմանը՝ իրականության եւ ...</p>

                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="presentation.html" class="btn more_btn">ԱՎԵԼԻՆ</a>
                                        <button class="btn add_cupon">ՊԱՏԻՎԻՐԵԼ
                                            <i class="fas fa-chevron-right"></i></button>
                                    </div>
                                    <p class='view-movie'>30 սեպտեմբեր 18։30</p>
                                    <p class="movie-lenght">120 ՐՈՊԵ<span>16+</span></p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="media">
                    <div class="row">
                        <div class="col-md-3  col-12">


                            <img src="/assets/images/item_img2.png" class="mr-5" alt="Photo">
                        </div>
                        <div class="col-md-9 col-12">

                            <div class="media-body">
                                <p class="author">ԳԱԲՐԻԵԼ ԳԱՐՍԻԱ ՄԱՐԿԵՍ </p>
                                <h5 class="mt-0 media-title">ՀԱՐՍԱՆԻՔ ԹԻԿՈՒՆՔՈՒՄ</h5>
                                <small class="movie-type">դրամա</small>
                                <p class="media-text">Ակնդետ ինձ էր նայում։ Ոչ մի կերպ չէի հասկանում՝ որտե՞ղ եմ
                                    տեսել։ Խոնավ, տագնապած
                                    հայացքը փայլկտաց նավթալամպի ընդհատուն լույսի մեջ։ Հիշեցի, ամեն գիշեր երազում
                                    այս
                                    սենյակն ու այս լամպն եմ տեսնում եւ տագնապած հայացքով այս աղջկան։ Այո, այո,
                                    ամեն
                                    անգամ, երբ հատում եմ երազատեսության երերուն սահմանը՝ իրականության եւ ...</p>

                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="#" class="btn more_btn">ԱՎԵԼԻՆ</a>
                                        <button class="btn add_cupon">ՊԱՏԻՎԻՐԵԼ <i
                                                class="fas fa-chevron-right"></i></button>

                                    </div>
                                    <p class='view-movie'>30 սեպտեմբեր 18։30</p>
                                    <p class="movie-lenght">120 ՐՈՊԵ<span>16+</span></p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <hr>
                <div class="media">
                    <div class="row">
                        <div class="col-md-3  col-12">


                            <img src="/assets/images/item_img3.png" class="mr-5" alt="Photo">
                        </div>
                        <div class="col-md-9 col-12">

                            <div class="media-body">
                                <aside class="aside_text aside-text_bg">ՓՈՔՐ ԹԱՏՐՈՆ</aside>
                                <p class="author">ԳԱԲՐԻԵԼ ԳԱՐՍԻԱ ՄԱՐԿԵՍ </p>
                                <h5 class="mt-0 media-title">ՀԱՍՄԻԿ</h5>
                                <small class="movie-type">դրամա</small>
                                <p class="media-text">Ակնդետ ինձ էր նայում։ Ոչ մի կերպ չէի հասկանում՝ որտե՞ղ
                                    եմ
                                    տեսել։ Խոնավ, տագնապած
                                    հայացքը փայլկտաց նավթալամպի ընդհատուն լույսի մեջ։ Հիշեցի, ամեն գիշեր
                                    երազում այս
                                    սենյակն ու այս լամպն եմ տեսնում եւ տագնապած հայացքով այս աղջկան։ Այո,
                                    այո, ամեն
                                    անգամ, երբ հատում եմ երազատեսության երերուն սահմանը՝ իրականության եւ ...
                                </p>

                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="#" class="btn more_btn">ԱՎԵԼԻՆ</a>
                                        <button class="btn add_cupon">ՊԱՏԻՎԻՐԵԼ <i
                                                class="fas fa-chevron-right"></i></button>
                                    </div>
                                    <p class='view-movie'>30 սեպտեմբեր 18։30</p>
                                    <p class="movie-lenght">120 ՐՈՊԵ<span>16+</span></p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="media">
                    <div class="row">
                        <div class="col-md-3  col-12">


                            <img src="/assets/images/item_img4.png" class="mr-5" alt="Photo">
                        </div>
                        <div class="col-md-9 col-12">

                            <div class="media-body">
                                <aside class="aside_text">ՀՅՈՒՐԱԽԱՂ</aside>
                                <p class="author">ԳԱԲՐԻԵԼ ԳԱՐՍԻԱ ՄԱՐԿԵՍ </p>
                                <h5 class="mt-0 media-title">ԵՐԿՆԱԳՈՒՅՆ ՇԱՆ ԱՉՔՈՐԸ</h5>
                                <small class="movie-type">դրամա</small>
                                <p class="media-text">Ակնդետ ինձ էր նայում։ Ոչ մի կերպ չէի հասկանում՝
                                    որտե՞ղ
                                    եմ
                                    տեսել։ Խոնավ, տագնապած
                                    հայացքը փայլկտաց նավթալամպի ընդհատուն լույսի մեջ։ Հիշեցի, ամեն գիշեր
                                    երազում այս
                                    սենյակն ու այս լամպն եմ տեսնում եւ տագնապած հայացքով այս աղջկան։
                                    Այո,
                                    այո, ամեն
                                    անգամ, երբ հատում եմ երազատեսության երերուն սահմանը՝ իրականության եւ
                                    ...
                                </p>

                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="#" class="btn more_btn">ԱՎԵԼԻՆ</a>
                                        <button class="btn add_cupon">ՊԱՏԻՎԻՐԵԼ <i
                                                class="fas fa-chevron-right"></i></button>
                                    </div>
                                    <p class='view-movie'>30 սեպտեմբեր 18։30</p>
                                    <p class="movie-lenght">120 ՐՈՊԵ<span>16+</span></p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <hr>


                <div>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">
										<i class="fas fa-chevron-left"></i>
									</span>

                            </a>
                        </li>
                        <li class="page-item "><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item active"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>

                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">
										<i class="fas fa-chevron-right"></i>
									</span>
                            </a>
                        </li>
                    </ul>
                </div>
                Երեքշաբթի
            </div>

            <div class="tab-pane fade" id="nav-wed" role="tabpanel" aria-labelledby="nav-wed-tab">
                Չորեքշաբթի
            </div>

            <div class="tab-pane fade" id="nav-thur" role="tabpanel" aria-labelledby="nav-thur-tab">
                Հինգշաբթի
            </div>
            <div class="tab-pane fade" id="nav-fri" role="tabpanel" aria-labelledby="nav-fri-tab">
                Ուրբաթ
            </div>
            <div class="tab-pane fade" id="nav-sat" role="tabpanel" aria-labelledby="nav-sat-tab">
                Շաբաթ
            </div>
            <div class="tab-pane fade" id="nav-sun" role="tabpanel" aria-labelledby="nav-sun-tab">
                Կիրակի
            </div>-->

        </div>



    </div>

</main>

<section class="new_section p-2">
    <div class="container ">
        <h3 class="new_section-title">ՇՈՒՏՈՎ</h3>
        <div class="row">
            <div class="col-md-7 boredr">
                <div class="media-body">
                    <h5 class="mt-0 media-title"><?= $performanceSoon->title; ?></h5>
                    <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $performanceSoon->id])->asArray()->all();
                    $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                    <small class="movie-type">
                        <?php $str = '';
                        foreach ($genre as $item){
                            $str .= ' '.$item.',';
                        }
                        echo trim($str, ','); ?>
                    </small>
                    <p class="author"><?= $performanceSoon->author; ?></p>
                    <p class="media-text">
                        <?= substr($performanceSoon->desc,0,351); ?>
                        <?= strlen($performanceSoon->desc) > 351 ? '...' : ''; ?>
                    </p>

                    <div class="media-footer">
                        <div class="media_btn-group">
                            <a href="/performance/view?id=<?= $performanceSoon->id; ?>" class="btn more_btn">ԱՎԵԼԻՆ</a>
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
    <p class="number-text">ՏԵՂԵԿԱՏՈՒ ՀԵՌԱԽՈՍԱՀԱՄԱՐ</p>
    <h5 class="call-number">060 96 10 10</h5>
</article>
