<?php use common\models\Performance;
use yii\helpers\Url; ?>
<div class="performances-page about_pages">
    <div id="hero" class="carousel slide carousel-fade performance_header" data-ride="carousel">
        <div class="scrollme">
            <h1 class="baner_title mt-5"><?= Yii::t('home', 'Որոնման արդյունք') ?></h1>
        </div>
    </div>
    <div class="form-group has-search">
        <form action="/site/search" method="get">
            <i class="fas fa-search search_icon"></i>
            <input value="<?= Yii::$app->request->get('search') ? Yii::$app->request->get('search') : '' ?>"
                   type="text" class="search_input_form" name="search" placeholder="<?= Yii::t('home', 'Որոնել') ?>" required>
            <div class="media-footer">
                <div class="media_btn-group">
                    <input type="submit" class="btn more_btn search_button text-uppercase" value="<?= Yii::t('home', 'Որոնել') ?>">
                </div>
            </div>
        </form>
    </div>
</div>

<main class="main_movies mb-5">
    <div class="container main_container" style="min-height: 600px;">
        <?php if (Yii::$app->request->get() && empty($searchInformation['performance']) &&
            empty($searchInformation['staff']) && empty($searchInformation['news']) && empty($searchInformation['archive'])) : ?>
        <div align="center" class="w-100 m-0">
            <h1 class="mt-3 mb-3" style="font-family: 'Arm Hmks';"><?= Yii::t('home','Որևէ տվյալ չի գտնվել') ?></h1>
        </div>
        <?php endif; ?>

        <?php if(!empty($searchInformation['performance']) && isset($searchInformation['performance'])) : ?>
        <div class="d-flex mb-3 wv3">
            <h2 class="mb-0 title-type" style="width: 15%;"><b><?= Yii::t('home', 'ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ'); ?></b></h2>
            <div class="title-side-line"></div>
        </div>
        <?php foreach ($searchInformation['performance'] as $performance) : ?>
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

        <?php if(!empty($searchInformation['staff']) && isset($searchInformation['staff'])) : ?>
        <div class="d-flex m2-3 mt-4 wv3">
            <h2 class="mb-0 title-type"><b><?= Yii::t('home', 'ԴԵՐԱՍԱՆՆԵՐ'); ?></b></h2>
            <div class="title-side-line"></div>
        </div>
        <section class="actors_lists mt-0">
                <div class="actors_main_my row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2" style="width: 103%!important;">
                    <?php foreach ($searchInformation['staff'] as $item): ?>
                        <div class="col" style="padding-right: 10px;padding-left: 10px;">
                            <a href="<?=  Url::to(['/staff/view', 'slug' => Yii::t('text', $item['slug'])]);?>">
                                <div class="actor">
                                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/400/'.$item['img_path']; ?>" alt="Photo">
                                    <h6 class="actor_name"><?= Yii::t('text', $item['first_name']).' '.Yii::t('text', $item['last_name']); ?></h6>
                                    <span class="actor_type"><?= Yii::t('text', $item['staff_genre_type']) ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
        </section>
        <hr>
        <?php endif; ?>

        <?php if (!empty($searchInformation['news']) && isset($searchInformation['news'])) : ?>
        <div class="d-flex mb-3 wv3">
            <h2 class="mb-0 title-type"><b><?= Yii::t('home', 'Նորություններ'); ?></b></h2>
            <div class="title-side-line"></div>
        </div>
        <?php foreach ($searchInformation['news'] as $content) : ?>
        <div class="media d-block">
            <div class="row performances_main p-1 news_block">
                <div class="col-md-2  col-12 p-0">
                    <a href="<?=  Url::to(['/news/view', 'id' => $content['id']]); ?>">
                        <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/news/400/'.$content['img_path']; ?>" class="w-100" alt="Photo" style="height: 170px;">
                    </a>
                </div>
                <div class="col-md-10 col-12">
                    <div class="media-body">
                        <a href="<?=  Url::to(['/news/view', 'id' => $content['id']]); ?>">
                            <h5 class="mt-0 media-title"><?= Yii::t('text', $content['title']); ?></h5>
                        </a>
                        <p class="media-text">
                            <?= mb_substr(Yii::t('text', $content['content']),0,190, 'utf-8'); ?>
                            <?= strlen(Yii::t('text', $content['content'])) > 190 ? '...' : ''; ?>
                        </p>
                        <div class="media-footer">
                            <div class="media_btn-group d-flex justify-content-between w-100">
                                <a href="<?=  Url::to(['/news/view', 'id' => $content['id']]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                <span class="view-movie"><?= Performance::getPerformanceTime($content['dt_create']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>
</main>