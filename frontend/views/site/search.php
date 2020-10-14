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
    <div class="container p-3">
        <?php if (Yii::$app->request->get() && empty($searchInformation['performance']) &&
            empty($searchInformation['staff']) && empty($searchInformation['news']) && empty($searchInformation['archive'])) : ?>
        <div align="center" class="w-100 m-0">
            <h1 class="mt-3 mb-3 w-50"><?= Yii::t('home','Որևէ տվյալ չի գտնվել։') ?></h1>
        </div>
        <?php endif; ?>

        <?php if(!empty($searchInformation['performance']) && isset($searchInformation['performance'])) : ?>
            <h2 class="mb-0 mt-4 title-type"><b><?= Yii::t('home', 'ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ'); ?></b></h2>
                <?php foreach ($searchInformation['performance'] as $item) : ?>
                <div class="media d-block">
                    <div class="row">
                        <div class="col-md-3  col-12">
                            <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item['slug'])]); ?>">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item['img_path']; ?>" class="mr-5" alt="Photo">
                            </a>
                        </div>
                        <div class="col-md-9 col-12">
                            <div class="media-body">
                                <?php if ($item['hall'] == 1) : ?>
                                    <aside class="aside_text aside-text_bg text-uppercase"><?= Yii::t('home', 'ՓՈՔՐ ԹԱՏՐՈՆ'); ?></aside>
                                <?php elseif ($item['hall'] == 2) : ?>
                                    <aside class="aside_text"><?= Yii::t('home', 'ՀՅՈՒՐԱԽԱՂ'); ?></aside>
                                <?php endif; ?>
                                <p class="author"><?= Yii::t('text', $item['author']); ?></p>
                                <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item['slug'])]); ?>">
                                    <h5 class="mt-0 media-title"><?= Yii::t('text', $item['title']); ?></h5>
                                </a>
                                <small class="movie-type"><?= $item['genre']; ?></small>
                                <p class="media-text">
                                    <?= mb_substr(Yii::t('text', $item['desc']),0,250, 'utf-8'); ?>
                                    <?= strlen(Yii::t('text', $item['desc'])) > 250 ? '...' : ''; ?>
                                </p>
                                <div class="media-footer">
                                    <div class="media_btn-group">
                                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item['slug'])]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                        <?php if ($item['show_date'] > date("Y-m-d H:i:s")): ?>
                                            <button class="btn add_cupon"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?>
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <p class='view-movie'><?= $item['func_date']; ?></p>
                                    <p class="movie-lenght"><?= $item['performance_length']; ?> <?= Yii::t('home', 'ՐՈՊԵ') ?><span><?= $item['age_restriction']; ?>+</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

        <?php if(!empty($searchInformation['staff']) && isset($searchInformation['staff'])) : ?>
        <h2 class="mb-0 mt-4 title-type"><b><?= Yii::t('home', 'ԴԵՐԱՍԱՆՆԵՐ'); ?></b></h2>
        <section class="actors_lists mt-0">
            <div class="actors_main_my row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 w-100">
                <?php foreach ($searchInformation['staff'] as $item): ?>
                    <div class="col">
                        <a href="<?=  Url::to(['/staff/view', 'slug' => Yii::t('text', $item['slug'])]);?>">
                            <div class="actor">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item['img_path']; ?>" alt="Photo">
                                <h6 class="actor_name"><?= Yii::t('text', $item['first_name']).' '.Yii::t('text', $item['last_name']); ?></h6>
                                <span class="actor_type"><?= Yii::t('home', 'Դերասան') ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <hr>
        <?php endif; ?>

        <?php if (!empty($searchInformation['news']) && isset($searchInformation['news'])) : ?>

            <h2 class="mb-0 mt-4 title-type"><b><?= Yii::t('home', 'Նորություններ'); ?></b></h2>
            <?php foreach ($searchInformation['news'] as $item) : ?>
                <div class="media d-block">
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <a href="<?=  Url::to(['/news/view', 'id' => $item['slug']]); ?>">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/news/200/'.$item['img_path']; ?>" class="w-100" alt="Photo">
                            </a>
                        </div>
                        <div class="col-md-10 col-12">
                            <div class="media-body">
                                <a href="<?=  Url::to(['/news/view', 'id' => $item['slug']]); ?>">
                                    <h5 class="mt-0 media-title"><?= Yii::t('text', $item['title']); ?></h5>
                                </a>
                                <p class="media-text">
                                    <?= mb_substr(Yii::t('text', $item['content']),0,190, 'utf-8'); ?>
                                    <?= strlen(Yii::t('text', $item['content'])) > 190 ? '...' : ''; ?>
                                </p>
                                <div class="media-footer">
                                    <div class="media_btn-group d-flex justify-content-between w-100">
                                        <a href="<?=  Url::to(['/news/view', 'id' => $item['slug']]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                        <span class="view-movie"><?= Performance::getPerformanceTime($item['dt_create']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($searchInformation['archive']) && isset($searchInformation['archive'])) : ?>

            <h2 class="mb-0 mt-4 title-type"><b><?= Yii::t('home', 'Արխիվ'); ?></b></h2>
            <?php foreach ($searchInformation['archive'] as $item) : ?>
                <div class="media d-block">
                    <div class="row">
                        <div class="col-md-2  col-12">
                            <a href="<?=  Url::to(['/archive/view', 'id' => $item['slug']]); ?>">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/archive/200/'.$item['img_path']; ?>" class="w-100" alt="Photo">
                            </a>
                        </div>
                        <div class="col-md-10 col-12">
                            <div class="media-body">
                                <a href="<?=  Url::to(['/archive/view', 'id' => $item['slug']]); ?>">
                                    <h5 class="mt-0 media-title"><?= Yii::t('text', $item['title']); ?></h5>
                                </a>
                                <p class="media-text">
                                    <?= mb_substr(Yii::t('text', $item['content']),0,190, 'utf-8'); ?>
                                    <?= strlen(Yii::t('text', $item['content'])) > 190 ? '...' : ''; ?>
                                </p>
                                <div class="media-footer">
                                    <div class="media_btn-group d-flex justify-content-between w-100">
                                        <a href="<?=  Url::to(['/archive/view', 'id' => $item['slug']]); ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                        <span class="view-movie"><?= Performance::getPerformanceTime($item['dt_create']); ?></span>
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


