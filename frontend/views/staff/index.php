<?php use common\models\Role;
use yii\widgets\LinkPager; ?>
<div class="actors_page">
    <div class="container">
        <div class="d-flex">
            <h2 class="mb-0 title-type" style="width: 12%;"><b><?= Yii::t('home', 'Վարչական մաս'); ?></b></h2>
            <div class="title-side-line"></div>
        </div>
        <?php if (!empty($model) && isset($model)): ?>
            <section class="performance_movie">
                <div class="row">
                    <?php foreach ($model as $item): ?>
                        <div class="col-md-4">
                            <a href="">
                                <div class="media_present">
                                    <div class="media">
                                        <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/200/'.$item->img_path; ?>"
                                             class="align-self-center mr-3 present_baner" alt="...">
                                        <div class="media-body">
                                            <span class="author"><?= Yii::t('text', Role::find()->where(['id' => $item->role_id])->one()->name); ?></span>
                                            <h5 class="mt-0 performance_name"><?= Yii::t('text', $item->first_name).' '.Yii::t('text', $item->last_name); ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
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