<?php use common\models\Performance; ?>
<div class="news_page">
    <div class="container main_container">
        <section class="actros_carousel">
            <div class="row">
                <div class="col-md-3 col-12">
                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/news/original/'.$model->img_path; ?>" class="actors_photo" alt="Photo">
                </div>
                <div class="col-md-9 col-12 order-md-1 order-4 news_content media-footer">
                    <div class="about_actros">
                        <div class="about_act_title">
                            <h5 class="mt-0 actros_name"><?= Yii::t('text', $model->title); ?></h5>
                        </div>
                    </div>
                    <p class="actros_about_text">
                        <?= Yii::t('text', $model->content); ?>
                    </p>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <span class="view-movie"><?= Performance::getPerformanceTime($model->dt_create); ?></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>