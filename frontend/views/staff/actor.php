<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>

    <div class="container">
        <h2 class="mb-0 title-type" style="margin-top: 130px;"><b><?= Yii::t('home', 'Դերասաններ'); ?></b></h2>
        <section class="actors_lists mt-0">
            <?php if (!empty($model) && isset($model)): ?>
            <div class="actors_main_my row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 w-100">
                <?php foreach ($model as $item): ?>
                    <div class="col">
                        <a href="<?=  Url::to(['/staff/view', 'slug' => Yii::t('text', $item->slug)]);?>">
                            <div class="actor">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item->img_path; ?>" alt="Photo">
                                <h6 class="actor_name"><?= Yii::t('text', $item->first_name).' '.Yii::t('text', $item->last_name); ?></h6>
                                <span class="actor_type"><?= Yii::t('home', 'Դերասան') ?></span>
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





