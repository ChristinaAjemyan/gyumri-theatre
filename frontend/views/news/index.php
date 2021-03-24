<?php use common\models\Performance;
use yii\helpers\Url;
use yii\widgets\LinkPager;  ?>
<main class="main_movies mb-5">
    <div class="container" style="padding: 120px 30px; min-height: 600px;">
        <div class="tab-content" id="nav-tabContent">

            <?php if (!empty($contents) && isset($contents)) : ?>
                <?php foreach ($contents as $content) : ?>
                    <div class="media d-block pt-4">
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
                                        <div class="media_btn-group news_sett w-100">
                                            <a href="<?=  Url::to(['/news/view', 'id' => $content['id']]); ?>" class="btn more_btn news_more"><?= Yii::t('home', 'ԱՎԵԼԻՆ') ?></a>
                                            <span class="view-movie"><?= Performance::getPerformanceTime($content['dt_create']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center h2 remove" style="font-family: 'Arm Hmks'">
                    <?= Yii::t('app', 'Արդյունք չի գտնվել') ?>
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