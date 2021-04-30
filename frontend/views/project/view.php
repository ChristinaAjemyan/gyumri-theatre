<?php

use common\models\Performance;
use yii\helpers\Url;

?>
<div class="performances-page">
    <div id="hero" class="carousel slide carousel-fade performance_header mb-3" data-ride="carousel"
         style="position: relative;background: url(<?= Yii::$app->params['backend-url'] . '/upload/banners/' . $project->banner; ?>) no-repeat center;"></div>
    <div class="bg-white mb-5">
        <div class="container main_container">
            <section class="about-present main_movies">
                <div class="media">
                    <div class="row">
                        <div class="col-md-4  col-12 view_img_content">
                            <img style="max-width: 96%;width: 96%;height: auto;object-fit: cover;border-radius: unset;"
                                 src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/project/200/' . $project->img_path; ?>"
                                 alt="<?= $project->img_path; ?>">
                        </div>
                        <div class="col-md-8 col-12 view_text_content">

                            <div class="media-body" style="position: relative">
                                <h1 class="mt-0 media-title"
                                    style="max-width: 90%;"><?= Yii::t('text', $project->title); ?></h1>
                                <?php if (!empty($project->video_link) && isset($project->video_link)): ?>
                                    <span class="btn_play about_popup_youtube" style="margin: -11px 0 0 0;right: 0px!important;top: 15px!important;">
                                        <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $project->video_link; ?>"><i
                                                    class="fas fa-play"></i></a></span>
                                <?php endif; ?>
                                <div class="performance_ckeditor_content" style="max-height: 400px;" ><?= Yii::t('text', $project->description); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php if (!empty($images) && isset($images)): ?>
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="changeTab nav-item">
                <a class="active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                    <h2 class="block_title carousel_title mt-0 contact_block_title projectTabTitle" style="color: #ec7532;"><?= Yii::t('home', 'ԼՈՒՍԱՆԿԱՐՆԵՐ'); ?></h2>
                    <div id="project_photo_border" class="block_title_gred_line"></div>
                </a>
            </li>
            <li class="changeTab nav-item">
                <a class="" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                    <h2 class="block_title carousel_title mt-0 contact_block_title projectTabTitle" style="color: #c2c1c1;"><?= Yii::t('home', 'ՏԵՍԱՆՅՈՒԹԵՐ'); ?></h2>
                    <div id="project_video_border" class="block_title_gred_line" style="display: none;"></div>
                </a>
            </li>
        </ul>
        <div class="tab-content d-flex justify-content-center" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <section class="present-corusel">
                    <div class="container page_images_carousel">
                        <div class="ph_v_content">
                            <span class="title_line"></span>
                            <div class="performances-carusel owl-carousel " data-content="<?= count($images) ?>" id="view_performance">
                                <?php if (isset($images)&& !empty($images)): ?>
                                <?php foreach ($images as $image): ?>
                                    <div class="block-present carusel_block">
                                        <a href="<?= Yii::$app->params['backend-url'] . '/upload/avatars/project/original/' . $image->photo; ?>">
                                            <img src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/project/200/' . $image->photo; ?>"
                                                 alt="<?= $image->photo; ?>">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <div class="d-flex justify-content-center">
                                    <p class="text-center h2 remove" style="font-family: 'Arm Hmks';padding: 80px;">
                                        <?= Yii::t('home','Արդյունք չի գտնվել') ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <?php if (isset($videos) && !empty($videos)): ?>
                    <div class="container mb-3">
                        <div id="owl-demo-video" class="owl-carousel owl-theme mt-3">
                            <?php foreach ($videos as $video): ?>
                                <div class="item">
                                    <a href="https://www.youtube.com/watch?v=<?= $video['video_url']; ?>" target="_blank" class="popup_youtube">
                                    <div class="block-present carusel_block " data-id="<?= $video['video_url']; ?>">
                                        <iframe width="380" height="300"
                                                src="https://www.youtube.com/embed/<?= $video['video_url']; ?>"></iframe>
                                    </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="d-flex justify-content-center">
                        <p class="text-center h2 remove" style="font-family: 'Arm Hmks';padding: 80px;">
                            <?= Yii::t('home','Արդյունք չի գտնվել') ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <article class="article-call">
        <p class="number-text"><?= Yii::t('home', 'ՏԵՂԵԿԱՏՈՒ ՀԵՌԱԽՈՍԱՀԱՄԱՐ') ?></p>
        <h5 class="call-number">060 38 10 10</h5>
    </article>
</div>
<section class="about-carousel" style="transform: translateY(30px);">
    <div class="container">
        <div class="main_carousel owl-carousel" id="performances-carusel">
            <?php $performances = Performance::find()->orderBy([new \yii\db\Expression('show_date IS not NULL DESC, show_date ASC')])->limit(6)->all(); ?>
            <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                    <div class="carousel_item">
                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                            <div class="card">
                                <img class="card-img-top"
                                     style="height: 275px; max-width: 200px; object-fit: cover;margin: 0px 15px;"
                                     src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/performance/400/' . $item->img_path; ?>"
                                     alt="Card image cap">
                                <div class="footerStaffCol">
                                </div>
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
<?php
$js = <<<JS
    $(document).on('click','.changeTab',function() {
        $('.block_title_gred_line').css('display','none');
        $('.projectTabTitle').css('color' ,'#c2c1c1');
        $('.active > div').css('display','block');
        $('.active > h2').css('color' ,'#ec7532');
    })
    
    
    $("#owl-demo-video").owlCarousel({
     loop: true,
            margin: 10,
            nav: true,
            items: 3,
            navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
            autoHeight: false,
            center: true,
            dots: false,
            autoWidth:true,
            responsive: {
                768: {
                    items: 3
                },
                0 : {
                    items: 1,
                    center: false,
                    margin: 0,
                    autoWidth: false
                }
            },
    
  });
$(document).on('click','.projectTabTitle',function() {
    setTimeout(function() {
        $('#owl-demo-video >.owl-nav').hide();
    },500)
  
})
// setTimeout(function() {
//   $('.owl-nav').hide();
//   $('.owl-dots').hide();
// },1000)
JS;

$this->registerJs($js);
?>
