<?php
use common\models\Videolink;
$videos = Videolink::find()->where(['performance_id' => $id])->all();

?>
<?php if (!empty($videos) && isset($videos)) : ?>
<span class="title_line"></span>
<div class="performances-carusel owl-carousel" id="current_performance_v" data-content="<?=count($videos)?>">
    <?php foreach ($videos as $video): ?>
    <div class="video_carousel">
        <span class="btn_play about_popup_youtube" style="right: 38%;top: 30%;padding: 24px 25px 20px 26px;">
            <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $video->link; ?>"><i class="fas fa-play" style="font-size: 23px"></i></a>
        </span>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<p class="text-center h2 remove" style="font-family: 'Arm Hmks';padding: 80px;">
    <?= Yii::t('app', 'Արդյունք չի գտնվել') ?>
</p>
<?php endif; ?>
