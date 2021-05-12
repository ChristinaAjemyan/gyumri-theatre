<?php


use common\models\Performance;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<main class="main_movies mb-5">
    <div class="archive_page">
        <div class="archive_header">
            <div class="archive_header_content">
                <h1 class="archive_header_title"><?= Yii::t('home','ՆԱԽԱԳԾԵՐ') ?></h1>
            </div>
        </div>
    </div>
    <div class="container main_container perf">
        <div class="tab-content mt-4" id="nav-tabContent" style="min-height: 330px">
            <?php if (!empty($projects) && isset($projects)) : ?>
                <?php foreach ($projects as $k=> $project) : ?>
                    <div class="media d-block">
                        <div class="row performances_main">
                            <div class="col-md-3  col-12 p-0">
                                <a href="<?= Url::to(['/project/view', 'id'=>$project['id']]); ?>">
                                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/project/200/'.$project['img_path']; ?>" class="mr-5" alt="Photo">
                                </a>
                            </div>
                            <div class="col-md-9 col-12">
                                <div class="media-body mt-4">
                                    <a href="<?= Url::to(['/project/view', 'id' => $project['id']]); ?>">
                                        <h5 class="mt-0 media-title" style="max-width: 100%;"><?= Yii::t('text', $project['title']); ?></h5>
                                    </a>
                                    <p class="" style="max-height: 150px;">
                                        <?= mb_substr(Yii::t('text', $project['description']),0,500, 'utf-8'); ?>
                                        <?= strlen(Yii::t('text', $project['description'])) > 500 ? '...' : ''; ?>
                                    </p>
                                    <div class="media-footer">
                                        <div class="media_btn-group">
                                            <a href="<?= Url::to(['/project/view', 'id'=>$project['id']]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="d-flex justify-content-center">
                    <p class="text-center h2 remove" style="font-family: 'Arm Hmks';padding: 80px;">
                        <?= Yii::t('home','Արդյունք չի գտնվել') ?></p>
                </div>
            <?php endif; ?>


            <div class="table-content mt-5">
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