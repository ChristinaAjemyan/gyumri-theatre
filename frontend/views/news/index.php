<?php

use yii\widgets\LinkPager;
?>

<div class="container main_container mb-5" style="min-height: 730px;padding-top: 120px;">
    <section class="actors_lists mt-0">
        <?php if (!empty($contents) && isset($contents)): ?>
            <div class="actors_main_my row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2" style="width: 103%!important;">
                <?php foreach ($contents as $content): ?>
                    <div class="col" style="padding-right: 10px;padding-left: 10px;">
                        <div class="actor carusel_block p-0">
                            <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/news/200/'.$content['img_path']; ?>" style="height: 170px;width: 200px" alt="Photo">
                            <span class="btn_play about_popup_youtube" style="right: 31%;top: 29%;padding: 24px 25px 20px 26px;z-index: 99">
                            <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $content['videolink']; ?>"><i class="fas fa-play" style="font-size: 23px"></i></a>
                        </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <div>
        <?= LinkPager::widget([
            'pagination' => $pages,
            'maxButtonCount' => 6,
            'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
            'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
            'options' => [
                'class' => 'pagination actros_list_page'
            ]
        ]);?>
    </div>
</div>
<!--<main class="main_movies mb-5" style="min-height: 100vh">
    <div class="container" style="padding: 120px 30px; min-height: 600px;">
        <div class="tab-content" id="nav-tabContent">
            <?php /*if (!empty($contents) && isset($contents)) : */?>
            <div class="row mt-3">
                <?php /*foreach ($contents as $content) : */?>
                <div class="col-md-6 col-sm-12 mt-3 mb-2" style="border-radius: 10px;">
                    <div style="height: 175px;width: 250px;background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?/*= Yii::$app->params['backend-url'].'/upload/avatars/news/200/'.$content['img_path']; */?>);background-size: cover;">
                        <span class="btn_play about_popup_youtube" style="right: 35%;top: 29%;padding: 24px 25px 20px 26px;">
                            <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?/*= $content['videolink']; */?>"><i class="fas fa-play" style="font-size: 23px"></i></a>
                        </span>
                    </div>
                </div>
                <?php /*endforeach; */?>
            </div>
            <?php /*else: */?>
            <p class="text-center h2 remove" style="font-family: 'Arm Hmks'">
                <?/*= Yii::t('app', 'Արդյունք չի գտնվել') */?>
            </p>
            <?php /*endif; */?>
            <div class="mt-5">
                <?/*= LinkPager::widget([
                    'pagination' => $pages,
                    'maxButtonCount' => 6,
                    'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
                    'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
                    'options' => [
                        'class' => 'pagination actros_list_page'
                    ]
                ]);*/?>
            </div>
        </div>
    </div>
</main>-->