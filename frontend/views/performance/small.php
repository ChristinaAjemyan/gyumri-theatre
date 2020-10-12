<?php use yii\widgets\LinkPager;  ?>
<main class="main_movies mb-5">
    <div class="container p-3">
        <div style="margin-top: 120px" class="tab-content" id="nav-tabContent">
            <h2 class="mb-0 title-type"><b><?= Yii::t('home', 'ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ').' - '.Yii::t('home', 'ՓՈՔՐ ԹԱՏՐՈՆ'); ?></b></h2>
            <?php if (!empty($performances) && isset($performances)) : ?>
                <?php foreach ($performances as $performance) : ?>
                    <div class="media d-block">
                        <div class="row">
                            <div class="col-md-3  col-12">
                                <a href="/performance/view?id=<?= $performance['id']; ?>">
                                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$performance['img_path']; ?>" class="mr-5" alt="Photo">
                                </a>
                            </div>
                            <div class="col-md-9 col-12">
                                <div class="media-body">
                                    <aside class="aside_text aside-text_bg text-uppercase"><?= Yii::t('home', 'ՓՈՔՐ ԹԱՏՐՈՆ'); ?></aside>
                                    <p class="author"><?= Yii::t('text', $performance['author']); ?></p>
                                    <a href="/performance/view?id=<?= $performance['id']; ?>">
                                        <h5 class="mt-0 media-title"><?= Yii::t('text', $performance['title']); ?></h5>
                                    </a>
                                    <small class="movie-type"><?= $performance['genre']; ?></small>
                                    <p class="media-text">
                                        <?= mb_substr(Yii::t('text', $performance['desc']),0,250, 'utf-8'); ?>
                                        <?= strlen(Yii::t('text', $performance['desc'])) > 250 ? '...' : ''; ?>
                                    </p>
                                    <div class="media-footer">
                                        <div class="media_btn-group">
                                            <a href="/performance/view?id=<?= $performance['id']; ?>" class="btn more_btn"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                            <?php if ($performance['show_date'] > date("Y-m-d H:i:s")): ?>
                                                <button class="btn add_cupon"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?>
                                                    <i class="fas fa-chevron-right"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                        <p class='view-movie'><?= $performance['func_date']; ?></p>
                                        <p class="movie-lenght"><?= $performance['performance_length']; ?> <?= Yii::t('home', 'ՐՈՊԵ') ?><span><?= $performance['age_restriction']; ?>+</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
    </div>
</main>
