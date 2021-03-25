<?php
use common\models\Image;
$images = Image::find()->where(['performance_id' => $id])->all();
?>
<span class="title_line"></span>
<div class="performances-carusel owl-carousel" id="current_performance_ph">
    <?php foreach ($images as $image): ?>
        <div class="block-present carusel_block">
            <a href="<?= Yii::$app->params['backend-url'].'/upload/galleries/original/'.$image->image; ?>">
                <img src="<?= Yii::$app->params['backend-url'].'/upload/galleries/250/'.$image->image; ?>" alt="Photo">
            </a>
        </div>
    <?php endforeach; ?>
</div>