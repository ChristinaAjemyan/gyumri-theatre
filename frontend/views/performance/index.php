<?php use common\models\Performance;
use common\models\Type;
use yii\helpers\Url;
use yii\widgets\LinkPager; ?>

<main class="main_movies mb-5">
    <div class="archive_page">
        <div class="archive_header">
            <div class="archive_header_content">
                <h1 class="archive_header_title"><?= Yii::t('home','Ներկայացումներ') ?></h1>
                <p class="archive_header_text"><?= Yii::t('home','Տոմսեր կարող եք ձեռք բերել գյումրու դրամատիկական թատրոնի տոմսարկղից կամ պատվիրել առցանց') ?></p>
            </div>
        </div>

        <div align="center" style="background: white;">
            <div class="mb-3 ml-1 performance_filter">
                <?php
                $types = Type::find()->all();
//                $default_tab = 'երեկոյան';
                ?>
                <?php if (isset($types)): ?>
                <?php foreach ($types as $type) : ?>
                    <button type="button" class="performance_tab_cont client_tab <?/*=$type->title == $default_tab ? 'active' : ''*/?>" data-toggle="pill" aria-controls="custom-tabs-one-client" data-id="<?= $type->id ?>" aria-selected="false" style="<?/*= $type->title == $default_tab ? 'border-bottom: 3px solid rgb(225, 136, 72);' : '' */?>"><?= $type->title ?></button>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <div class="container main_container perf">
        <div class="tab-content" id="nav-tabContent" style="min-height: 330px">
                <?php if (!empty($performances) && isset($performances)) : ?>
                <?php foreach ($performances as $performance) : ?>
                <div class="media d-block">
                    <div class="row performances_main">
                        <div class="col-md-3  col-12 p-0">
                            <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance['slug'])]); ?>">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$performance['img_path']; ?>" class="mr-5" alt="Photo">
                            </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body mt-4">
                                <?= \common\models\Performance::asideHallName($performance['hall'])  ?>
                                <p class="author"><?= Yii::t('text', $performance['author']); ?></p>
                                <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance['slug'])]); ?>">
                                    <h5 class="mt-0 media-title" style="max-width: 100%;"><?= Yii::t('text', $performance['title']); ?></h5>
                                </a>
                                <small class="movie-type"><?= $performance['genre']; ?></small>
                                <p class="media-text">
                                    <?= mb_substr(Yii::t('text', $performance['short_desc']),0,370, 'utf-8'); ?>
                                    <?= strlen(Yii::t('text', $performance['short_desc'])) > 370 ? '...' : ''; ?>
                                </p>
                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance['slug'])]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                        <?php if ($performance['external_id']) : ?>
                                        <a class="btn add_cupon showModalOrdering" data-id="<?=$performance['external_id']?>"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($performance['hall'] == '2' && $performance['tour_link']) : ?>
                                            <a href="<?=$performance['tour_link']?>" class="btn add_cupon"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?>
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                    <p class="movie-lenght">
                                        <?php if (!empty($performance['performance_length']) && isset($performance['performance_length'])) : ?>
                                            <?= $performance['performance_length']; ?> <?= Yii::t('home', 'ՐՈՊԵ') ?>
                                        <?php endif; ?>
                                        <?php if (!empty($performance['age_restriction']) && isset($performance['age_restriction'])) : ?>
                                            <span><?= $performance['age_restriction']; ?>+</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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