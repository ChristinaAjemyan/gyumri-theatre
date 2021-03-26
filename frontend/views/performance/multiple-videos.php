<?php
use common\models\Videolink;
$videos = Videolink::find()->where(['performance_id' => $id])->all();
?>
<span class="title_line"></span>
<div class="performances-carusel owl-carousel" id="current_performance_v">
    <?php foreach ($videos as $video): ?>
        <div style="background: black; height: 175px;width: 270px">
            <span class="btn_play about_popup_youtube" style="right: 38%;top: 30%;padding: 24px 25px 20px 26px;">
                <a target="_blank" class="popup_youtube" href="https://www.youtube.com/watch?v=<?= $video->link; ?>"><i class="fas fa-play" style="font-size: 23px"></i></a>
            </span>
        </div>
    <?php endforeach; ?>
</div>
<?php
