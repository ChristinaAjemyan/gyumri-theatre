<?php

use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>
<div class="archive_page" style="background: white;">
    <div class="archive_header">
        <div class="archive_header_content">
            <h1 class="archive_header_title mt-5"><?= Yii::t('home', 'ՆՈՐՈՒԹՅՈՒՆՆԵՐ') ?></h1>
        </div>
    </div>
</div>
<?php $role=(isset($_GET['role']))?$_GET['role']:'videos'; ?>
<section class="mt-1">
    <div class="container-fluid bg-white">
        <div class="d-flex justify-content-center">
            <nav class="newsNavWidth">
                <div class="nav nav-tabs newsPageTab" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link col-lg-6 col-md-6 col-12 w-50 h3 d-flex justify-content-center p-3 newsPageTabChanges <?= ($role=='videos')?'active':''; ?>" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="true" data-content="Videos">
                        <div class="row" style="width: 80%;">
                            <div class="col-12 d-flex justify-content-center newsPageTableTitle newsActiveTextColor">
                                <?= Yii::t('home', 'ՏԵՍԱՆՅՈՒԹԵՐ') ?>
                            </div>
                            <div class="col-12 newsNavActiveBorder">
                                <div></div>
                            </div>
                        </div>
                    </a>
                    <a class="nav-item nav-link col-lg-6 col-md-6 col-12 w-50 h3 d-flex justify-content-center p-3 newsPageTabChanges <?= ($role=='articles')?'active':''; ?>" id="nav-articles-tab" data-toggle="tab" href="#nav-articles" role="tab" aria-controls="nav-articles" aria-selected="false" data-content="Articles">
                        <div class="row" style="width: 80%;">
                            <div class="col-12 d-flex justify-content-center newsPageTableTitle newsActiveTextColor">
                                <?= Yii::t('home', 'ՀՈԴՎԱԾՆԵՐ') ?>
                            </div>
                            <div class="col-12 newsNavActiveBorder">
                                <div></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="newsTabBorderLine"></div>
            </nav>
        </div>
    </div>
    <div>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade <?= ($role=='videos')?'show active':''; ?>" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                <div class="container main_container" style="padding-top: 40px;">
                    <?php Pjax::begin();?>
                    <div class="row">
                        <?php if (isset($contents) && !empty($contents)): ?>
                            <?php foreach ($contents as $content): ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 p-0 rounded pb-3" style="width: 90.1%; ">
                                    <div class="d-flex justify-content-center">
                                        <div style="box-shadow: 0 2px 5px 3px silver;border-radius: 10px;border-collapse: collapse;">
                                            <img src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/news/200/' . $content['img_path']; ?>" alt="<?= $content['img_path']; ?>" style="object-fit: cover;height: 150px;width: 250px;border-radius: 10px 10px 0px 0px;filter: grayscale(80%);">
                                            <div class="newsVideoUnderLine"></div>
                                            <div class="d-flex justify-content-center bg-white p-1" style="font-size: 20px;font-family: Sans-Serif; border-radius: 0px 0px 10px 10px;;"><?= (strlen($content['title'])>21)?mb_substr(Yii::t('text',$content['title']),0,20).'...':Yii::t('text',$content['title']);?></div>
                                            <span class="btn_play about_popup_youtube about_popup_youtube_span">
                                            <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $content['videolink']; ?>"><i class="fas fa-play" style="font-size: 23px"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                    <div class="d-flex justify-content-center">
                        <?= LinkPager::widget([
                            'pagination' => $pages,
                            'maxButtonCount' => 6,
                            'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
                            'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
                            'options' => [
                                'id'=>'newsPagePagination_Video',
                                'class' => 'pagination actros_list_page'
                            ]
                        ]);?>
                    </div>
                    <?php Pjax::end(); ?>
                </div>
            </div>
            <div class="tab-pane fade <?= ($role=='articles')?'show active':''; ?>" id="nav-articles" role="tabpanel" aria-labelledby="nav-articles-tab">
                <?php Pjax::begin();?>
                <div class="container">
                    <?php if (isset($contentsTwo) && !empty($contentsTwo)): ?>
                    <?php foreach ($contentsTwo as $item): ?>
                        <div class="row ml-2 mr-2 mt-4 bg-white p-0" style="box-shadow: 0 2px 5px 3px silver;border-radius: 10px 0px 0px 10px;">
                            <div class="col-12 col-md-12 col-lg-4 p-0">
                                <img src="<?= Yii::$app->params['backend-url'] . '/upload/avatars/news/200/' . $item['img_path']; ?>"
                                     alt="<?= $item['img_path']; ?>"
                                     style="width: 360px;height: 245px;object-fit: cover;border-radius: 10px;">
                            </div>
                            <div class="col-12 col-md-12 col-lg-8">
                                <div class="row" style="margin-top: 15px;">
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-9"
                                         style="font-size: 32px; color: #404040;font-family: Sans-Serif;">
                                        <?= (strlen($item['title']) > 25) ? mb_substr(Yii::t('text', $item['title']), 0, 25, 'utf-8') . '...' : Yii::t('text', $item['title']); ?>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-3"
                                         style="font-size: 19px; color: #999999;font-family: Sans-Serif;<?= (empty($item['reference_source'])) ? 'margin: 28px 0px 0px 0px;' : '' ?>;">
                                        <?= (!empty($item['reference_source'])) ? $item['reference_source'] : ''; ?>
                                        <div style="width: 100%;background: linear-gradient(to right, #fbbd61, #ec7532);padding: 4px 0 0 0;margin: 4px 0px -19px 0px;"></div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <?php if (!empty(Yii::t('text', $item['content']))) {
                                        if (strlen(Yii::t('text', $item['content'])) > 310) {
                                            echo mb_substr(Yii::t('text', $item['content']), 0, 310, 'utf-8') . ' ...';
                                        } else {
                                            echo Yii::t('text', $item['content']);
                                        }
                                    } else {
                                        echo '';
                                    } ?>
                                    <div class="media-footer">
                                        <div class="media_btn-group mb-3">
                                            <?php if (!empty($item['source_url'])): ?>
                                            <a href="<?=$item['source_url']; ?>" target="_blank" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="newsTabBorderLine mt-4" style="margin-left: 6px!important;width: 99%!important;"></div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-center">
                    <?= LinkPager::widget([
                        'pagination' => $pagesTwo,
                        'maxButtonCount' => 6,
                        'prevPageLabel' => "<i class=\"fas fa-chevron-left\"></i>",
                        'nextPageLabel' => "<i class=\"fas fa-chevron-right\"></i>",
                        'options' => [
                            'id'=>'newsPagePagination_Articles',
                            'class' => 'pagination actros_list_page'
                        ]
                    ]);?>
                </div>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</section>

<?php
$js = <<<JS
$(document).on('click','.newsPageTabChanges',function() {
    let showValue = $(this).attr('data-content');
    let url = new URL(location.href);
        url.searchParams.set('show', showValue);
        window.history.pushState({}, '', url);
})
JS;
$this->registerJs($js);
?>