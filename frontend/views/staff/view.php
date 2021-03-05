<?php

use common\models\GenrePerformance;
use common\models\Performance;
use common\models\StaffImage;
use common\models\StaffPerformance;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>


<div class="actors_page">
    <div class="container main_container">

        <div class="row">
            <div class="col-md-4 col-12">
                <img style="max-width: 96%;width: 96%;height: auto;object-fit: cover;" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/staff/400/'.$model->img_path; ?>" class="mr-3" alt="Photo">
            </div>
            <div class="col-md-8 col-12 order-md-1 order-4">
                <div class="about_actros">
                    <div class="about_act_title">
                        <small class="actros_type"><?= $model->staff_genre_type ? Yii::t('text', $model->staff_genre_type) : ''; ?></small>
                        <h5 class="actros_name" style="color:#101010;margin-top: -10px;"><?= Yii::t('text', $model->first_name).' '.Yii::t('text', $model->last_name); ?></h5>
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
                <div class="actros_imges row">
                    <?php foreach ($images as $image): ?>
                    <div class="act_img mb-4">
                        <a href="<?= Yii::$app->params['backend-url'].'/upload/galleries/original/'.$image->image; ?>">
                            <img style="height: 129px; width:129px;object-fit: cover;" src="<?= Yii::$app->params['backend-url'].'/upload/galleries/250/'.$image->image; ?>" alt="Photo">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

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
                                <img src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$item->img_path; ?>"
                                     class="align-self-center mr-3 present_baner" alt="...">
                                <div class="media-body">
                                    <span class="author"><?= Yii::t('text', $item->author); ?></span>
                                    <h5 class="performance_name">
                                        <?= mb_substr(Yii::t('text', Yii::t('text', $item->title)),0,25, 'utf-8'); ?>
                                        <?= strlen(Yii::t('text', $item->title)) > 25 ? '...' : ''; ?>
                                    </h5>
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
<section class="about-carousel" style="transform: translateY(30px);">
    <div class="container">

        <div class="main_carousel owl-carousel" id="performances-carusel">
            <?php $performances = Performance::find()->orderBy(['id' => SORT_DESC])->limit(6)->all(); ?>
            <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                    <div class="carousel_item">
                        <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                            <div class="card">
                                <img class="card-img-top" style="height: 275px; max-width: 200px; object-fit: cover;margin: 0px 15px;" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/200/'.$item->img_path; ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= Yii::t('text', $item->title); ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <hr class="foote-and-carusel">
    </div>

</section>