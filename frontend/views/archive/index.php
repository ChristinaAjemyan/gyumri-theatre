<?php
use common\models\ArchiveImage;
use common\models\Performance;
use yii\helpers\Url;

?>
<div class="archive_page">
    <div  class="archive_header">
        <div class="archive_header_content">
            <h1 class="archive_header_title"><?= Yii::t('home','Արխիվ') ?></h1>
            <p class="archive_header_text"><?= Yii::t('home','Այս բաժնում ներկայացված է թատրոնի արխիվային նյութերը եվ  Տարեգրությունը՝ ըստ թատերաշրջանի') ?></p>
        </div>
    </div>

    <div class="theater_season">
            <div class="container">
                <?php if (!empty($theatre_seasons) && isset($theatre_seasons)) : ?>
                <div class="theater_season_carousel owl-carousel" id="season_carousel">
                    <?php foreach ($theatre_seasons as $season) : ?>

                        <!--theater_season_block  -->
                        <div class="theater_season_block season_time <?= $season->active_season ? 'active' : '' ?>" data-id="<?= $season->id ?>">
                            <span class="seasnon_number"><?= $season->title ?></span>
                            <p class="season_type"><?= Yii::t('home','ԹԱՏԵՐԱՇՐՋԱՆ') ?></p>
                        </div>

                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
<!--                <span class="archive_line"></span>-->
            </div>
        </div>
    <div id="nav-tabCont">
        <?php if(!empty($season_performances)) : ?>
        <section class="section_carousel archive_page_carousel">
            <div class="container">
                <h2 class="archive_page_carousel_title" style="margin-bottom: 35px;"><?= Yii::t('home','ԹԱՏԵՐԱՇՐՋԱՆՈՒՄ ԲԵՄԱԴՐՎԱԾ ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ') ?></h2>
                <div id="main_content_perf_data">
                    <div class="main_carousel owl-carousel archive_content_carousel" id="current_performance">
                        <?php foreach ($season_performances as $performance) : ?>
                            <div class="carousel_item">
                                <div class="card" style="width: 16rem;">
                                    <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance[0]->slug)]); ?>">
                                        <img class="big-carousel card-img-top" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$performance[0]->img_path; ?>" alt="Card image cap">
                                    </a>
                                    <div class="card-body">
                                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance[0]->slug)]); ?>">
                                            <h5 class="card-title"><?= Yii::t('text', $performance[0]->title); ?></h5>
                                        </a>
                                        <p class='card-text'><?= Performance::getPerformanceTime($performance[0]->show_date) != '01 Հունվար 01:00' ? Performance::getPerformanceTime($performance[0]->show_date) : ''; ?></p>

                                    </div>
<!--                                    <div class="card-body">
                                        <a href="<?/*= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance[0]->slug)]); */?>">
                                            <h5 class="card-title"><?/*= Yii::t('text',  $performance[0]->title ); */?></h5>
                                        </a>
                                        <p class="card-text"><?/*= Performance::getPerformanceTime($performance[0]->show_date) */?></p>
                                    </div>-->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <?php if(!empty($active_season)) : ?>
            <div class="archive_main_content">
                <div class="container" style="padding: 0 30px;">
                    <h2 class="archive_main_title  mt-5 mb-2"><?= $active_season->title ?> <?= Yii::t('home','ԹԱՏԵՐԱՇՐՋԱՆ') ?></h2>
                    <?= $active_season->content ?>
                </div>
            </div>
            <div class="container page_images_carousel">
                <div id="main_content_season_data">
                    <div class="performances-carusel owl-carousel" id="current_performance_slide">
                        <?php $archive_images = ArchiveImage::find()->where(['archive_id' => $active_season->id])->all(); ?>
                        <?php foreach ($archive_images as $archive_image) : ?>
                            <div class="block-present carusel_block">
                                <a href="<?= Yii::$app->params['backend-url'].'/upload/galleries/original/'.$archive_image->image; ?>">
                                    <img src="<?= Yii::$app->params['backend-url'].'/upload/galleries/250/'.$archive_image->image; ?>" alt="Photo">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>