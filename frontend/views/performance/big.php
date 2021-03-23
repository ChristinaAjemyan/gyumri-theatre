<?php use yii\helpers\Url;
use yii\widgets\LinkPager;  ?>
<main class="main_movies mb-5">
    <div class="container main_container" style="min-height: 600px;">
        <div style="margin-top: 120px" class="tab-content performance_title" id="nav-tabContent">
            <div class="d-flex mb-3 wv3">
                <h2 class="mb-0 title-type" style="width: 32%;"><b><?= Yii::t('home', 'Ներկայացումներ').' - '.Yii::t('home', 'Մեծ թատրոն'); ?></b></h2>
                <div class="title-side-line"></div>
            </div>
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
                                    <p class="author"><?= Yii::t('text', $performance['author']); ?></p>
                                    <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $performance['slug'])]); ?>">
                                        <h5 class="mt-0 media-title"><?= Yii::t('text', $performance['title']); ?></h5>
                                    </a>
                                    <small class="movie-type"><?= $performance['genre']; ?></small>
                                    <p class="media-text">
                                        <?= mb_substr(Yii::t('text', $performance['short_desc']),0,250, 'utf-8'); ?>
                                        <?= strlen(Yii::t('text', $performance['short_desc'])) > 250 ? '...' : ''; ?>
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
                                        <p class='view-movie'><?= $performance['func_date']; ?></p>
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
            <?php else: ?>
                <p class="text-center h2 remove" style="font-family: 'Arm Hmks'">
                    <?= Yii::t('app', 'Ներկայացում չի գտնվել') ?>
                </p>
            <?php endif; ?>
            <div class="mt-5">
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