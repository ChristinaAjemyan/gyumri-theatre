<?php

use common\models\GenrePerformance;
use common\models\StaffImage;
use common\models\StaffPerformance;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>


<div class="actors_page">
    <div class="container main_container">
        <section class="actros_carousel">
            <div class="row">
                <div class="col-md-3 col-12">
                    <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/400/'.$model->img_path; ?>" class="mr-3 actors_photo" alt="Photo">
                </div>
                <div class="col-md-9 col-12 order-md-1 order-4">
                    <div class="about_actros">
                        <div class="about_act_title">
                            <small class="actros_type"><?= $model->staff_genre_type ? Yii::t('text', $model->staff_genre_type) : ''; ?></small>
                            <h5 class="mt-0 actros_name"><?= Yii::t('text', $model->first_name).' '.Yii::t('text', $model->last_name); ?></h5>
                        </div>
                        <?php if (!empty($model->inst_url) && isset($model->inst_url)): ?>
                        <a href="https://instagram.com/<?= $model->inst_url; ?>" target="_blank" class="social_page_act"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                    </div>

                    <p class="actros_about_text">
                        <?= Yii::t('text', $model->desc); ?>
                    </p>
                </div>
                <?php $images = StaffImage::find()->where(['staff_id' => $model->id])->all(); ?>
                <?php if (!empty($images) && isset($images)): ?>
                <div class="col-12 order-md-2 order-3">
                    <div class="actros_imges">
                        <?php foreach ($images as $image): ?>
                        <div class="act_img">
                            <a href="<?= Yii::$app->params['backend-url'].'/upload/galleries/original/'.$image->image; ?>">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/galleries/250/'.$image->image; ?>" alt="Photo">
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </section>
        <?php $performances = StaffPerformance::find()->with('performance')->where(['staff_id' => $model->id])->all();
        $performance = ArrayHelper::map($performances, 'id', 'performance'); ?>
        <?php if (!empty($performance) && isset($performance)): ?>
        <h2 class="block_title carousel_title mt-0"><?= Yii::t('home', 'ԽԱՂԱՑԱԾ ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ') ?></h2>
        <span class="title_line"></span>
        <section class="performance_movie" style="min-height: auto; margin-top: 40px;">
            <div class="row">
                <?php foreach ($performance as $item): ?>
                <div class="col-md-4">
                    <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                        <div class="media_present">
                            <div class="media">
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item->img_path; ?>"
                                     class="align-self-center mr-3 present_baner" alt="...">
                                <div class="media-body">
                                    <span class="author"><?= Yii::t('text', $item->author); ?></span>
                                    <h5 class="mt-0 performance_name"><?= Yii::t('text', $item->title); ?></h5>
                                    <?php $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $item->id])->asArray()->all();
                                    $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name'); ?>
                                    <small class="movie_type">
                                        <?php $str = '';
                                        foreach ($genre as $value){
                                            $str .= ' '.Yii::t('text', $value).',';
                                        }
                                        echo trim($str, ','); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
    </div>
</div>