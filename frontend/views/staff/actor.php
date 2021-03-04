<?php

use common\models\Performance;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>

<div class="container main_container mb-5" style="min-height: 730px;">
    <div class="d-flex mb-2 wv3">
        <h2 class="mb-0 title-type actors_title" style="margin-top: 120px;"><b><?= Yii::t('home', 'Դերասաններ'); ?></b></h2>
        <div class="title-side-line"></div>
    </div>
    <section class="actors_lists mt-0">
        <?php if (!empty($model) && isset($model)): ?>
        <div class="actors_main_my row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2" style="width: 103%!important;">
            <?php foreach ($model as $item): ?>
                <div class="col">
                    <a href="<?=  Url::to(['/staff/view', 'slug' => Yii::t('text', $item->slug)]);?>">
                        <div class="actor">
                            <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item->img_path; ?>" alt="Photo">
                            <h6 class="actor_name"><?= Yii::t('text', $item->first_name).' '.Yii::t('text', $item->last_name); ?></h6>
                            <span class="actor_type"><?= Yii::t('text', $item->staff_genre_type) ?></span>
                        </div>
                    </a>
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

<section class="about-carousel" style="transform: translateY(30px);">
    <div class="container">

        <div class="main_carousel owl-carousel" id="performances-carusel">
            <?php $performances = Performance::find()->orderBy(['id' => SORT_DESC])->limit(6)->all(); ?>
            <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                    <div class="carousel_item">
                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                            <div class="card">
                                <img class="card-img-top" style="height: 275px; max-width: 200px; object-fit: cover;margin: 0px 15px;" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item->img_path; ?>" alt="Card image cap">
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