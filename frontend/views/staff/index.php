<?php

use common\models\Performance;
use common\models\Role;
use common\models\Type;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<?php

$role = isset($_GET['role']) && $_GET['role'] != '' ? $_GET['role'] : 'administrative';

?>

<main class="main_movies mb-5">
    <div class="archive_page" style="background: white;">
        <div class="archive_header">
            <div class="archive_header_content">
                <h1 class="archive_header_title mt-5"><?= Yii::t('home','Աշխատակազմ') ?></h1>
            </div>
        </div>

        <div class="container main_container">
            <section>
                <div class="row" style="position: relative;top: -65px;">
                    <?php if (isset($staff_primary) && !empty($staff_primary)) : ?>
                    <?php foreach ($staff_primary as $item) : ?>
                    <div class="col-md-6 col-sm-12" style="border-radius: 10px;">
                        <div class="media_present_st staff_pres mb-0">
                            <div class="media" style="padding:5px;">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/400/'.$item->img_path; ?>" class="staff_img h-auto" alt="Photo">
                                <div class="media-body my_media-body">
                                    <h1 class="mt-3 media-title" style="margin-bottom: -5px;font-size: 25px;"><?= Yii::t('text', $item->first_name).' '.Yii::t('text', $item->last_name); ?></h1>
                                    <p class="author mb-2" style="font-size: 13px"><?= $item->role->name; ?></p>
                                    <p style="text-indent: 20px;font-size: 14px;margin-bottom: 13px;font-family: sans-serif;text-align: justify;">
                                        <?= mb_substr(Yii::t('text', $item->index_description),0,240, 'utf-8'); ?>
                                        <?= strlen(Yii::t('text', $item->index_description)) > 240 ? '...' : ''; ?>
                                    </p>
                                    <div class="media-footer">
                                        <div class="media_btn-group m-auto">
                                            <a href="<?= Url::to(['/staff/view', 'slug' => Yii::t('text', $item->slug)]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
            <div align="center" style="background: white;">
                <section id="tabs" class="project-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <nav>
                                    <div class="nav nav-tabs nav-fill p-0 row" id="nav-tab" role="tablist">
                                        <a class="nav-item col-lg-6 col-md-12 client_tab tab_main  <?=$role == 'administrative' ? 'active' : '' ?>" id="nav-home-tab" data-role="administrative"
                                           data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                                            <?= Yii::t('text', 'Վարչական Կազմ') ?>
                                            <div class="hove_height staff_change_line_adm">
                                                <div></div>
                                            </div>
                                        </a>
                                        <a class="nav-item col-lg-6 col-md-12 client_tab tab_main <?=$role == 'artistic' ? 'active' : '' ?>" id="nav-profile-tab" data-role="artistic"
                                           data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                                            <?= Yii::t('text', 'Գեղ.-ստեղծագործական Կազմ') ?>
                                            <div class="hove_height staff_change_line_art">
                                                <div></div>
                                            </div>
                                        </a>
                                    </div>
                                </nav>
                                <?php Pjax::begin() ?>
                                <div class="tab-content" id="nav-tabContent #my_tab-content">
                                    <div class="tab-pane fade <?=$role == 'administrative' ? 'show active' : '' ?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="container main_container p-0">
                                            <?php if (!empty($model_staff_admin) && isset($model_staff_admin)): ?>
                                                <div class="performance_movie" style="min-height: auto;">
                                                    <div class="row">
                                                        <?php foreach ($model_staff_admin as $item): ?>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 p-0">
                                                                <a href="javascript:void(0)">
                                                                    <div class="media_present staff_pres">
                                                                        <div class="media p-0">
                                                                            <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/400/'.$item->img_path; ?>"
                                                                                 class="align-self-center mr-3 present_baner" alt="...">
                                                                            <div class="media-body" style="text-align: left;">
                                                                                <h5 class="mt-0 performance_name"><?= Yii::t('text', $item->first_name).' '.Yii::t('text', $item->last_name); ?></h5>
                                                                                <span class="author" style="height: unset"><?= Yii::t('text', Role::find()->where(['id' => $item->role_id])->one()->name); ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <?= LinkPager::widget([
                                                    'pagination' => $pages_staff_admin,
                                                    'maxButtonCount' => 6,
                                                    'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
                                                    'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
                                                    'options' => [
                                                        'class' => 'pagination actros_list_page administrative_pagination'
                                                    ]
                                                ]);?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade <?=$role == 'artistic' ? 'show active' : '' ?>" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="container main_container p-0">
                                            <?php if (!empty($model_staff_artist) && isset($model_staff_artist)): ?>
                                                <div class="performance_movie" style="min-height: auto;">
                                                    <div class="row">
                                                        <?php foreach ($model_staff_artist as $item): ?>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 p-0">
                                                                <a href="javascript:void(0)">
                                                                    <div class="media_present staff_pres">
                                                                        <div class="media p-0">
                                                                            <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/400/'.$item->img_path; ?>"
                                                                                 class="align-self-center mr-3 present_baner" alt="...">
                                                                            <div class="media-body" style="text-align: left;">
                                                                                <h5 class="mt-0 performance_name"><?= Yii::t('text', $item->first_name).' '.Yii::t('text', $item->last_name); ?></h5>
                                                                                <span class="author" style="height: unset"><?= Yii::t('text', Role::find()->where(['id' => $item->role_id])->one()->name); ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <?= LinkPager::widget([
                                                    'pagination' => $pages_staff_artist,
                                                    'maxButtonCount' => 6,
                                                    'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
                                                    'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
                                                    'options' => [
                                                        'class' => 'pagination actros_list_page artistic_pagination'
                                                    ]
                                                ]);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php Pjax::end() ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<section class="about-carousel" style="transform: translateY(30px);">
        <div class="container">
            <div class="main_carousel owl-carousel" id="performances-carusel">
                <?php $performances = Performance::find()->orderBy(['show_date' => SORT_ASC])->limit(6)->all(); ?>
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

<?php

$script = <<<JS

/*    let pageNumber = 1,
        defaultUrl = new URL(location.href),
        pageIndex = defaultUrl.pathname.search(/\d+/);  
    
    if (pageIndex !== -1) {
        pageNumber = defaultUrl.pathname.slice(pageIndex);
    }   */
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    $('.client_tab').click(function() {
        let role = $(this).data('role'),
            url = new URL(location.href);
            url.searchParams.set('role', role);
            window.history.pushState({}, '', url);
            $('.client_tab').css('border-bottom','none')
         if (url.searchParams.get('role') == 'artistic'){
             if (width < 1025){
                $(this).css('border-bottom','5px solid #f28c39')
             }
             $('.staff_change_line_adm').hide()
             $('.staff_change_line_art').show()
         } else if(url.searchParams.get('role') == 'administrative'){
             if (width < 1025){
                $(this).css('border-bottom','5px solid #f28c39')
             }
             $('.staff_change_line_art').hide()
             $('.staff_change_line_adm').show()
         }
/*        if (typeof $('.'+ role +'_pagination').get(1) !== typeof undefined) {
            $('.'+ role +'_pagination').get(1).click();
        }*/
    });

JS;

$this->registerJs($script);


?>