<?php use common\models\Performance;
use yii\helpers\Url;
use yii\widgets\LinkPager;  ?>
<main class="main_movies mb-5">
    <div class="container" style="padding: 0 30px; min-height: 600px;">
        <div style="margin-top: 120px" class="tab-content" id="nav-tabContent">
            <div class="d-flex">
                <h2 class="mb-0 title-type"><b><?= Yii::t('home', 'Նորություններ'); ?></b></h2>
                <div class="title-side-line"></div>
            </div>
            <?php if (!empty($contents) && isset($contents)) : ?>
                <?php foreach ($contents as $content) : ?>
                    <div class="media d-block">
                        <div class="row performances_main p-1 news_block">
                            <div class="col-md-2  col-12 p-0">
                                <a href="<?=  Url::to(['/news/view', 'id' => $content['id']]); ?>">
                                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/news/200/'.$content['img_path']; ?>" class="w-100" alt="Photo" style="height: 170px;">
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