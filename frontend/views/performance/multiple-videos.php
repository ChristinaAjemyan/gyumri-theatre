<?php
use common\models\Videolink;
$videos = Videolink::find()->where(['performance_id' => $id])->all();
?>
<span class="title_line"></span>
<div class="performances-carusel owl-carousel" id="current_performance_v">
    <?php foreach ($videos as $video): ?>
     <iframe width="270" height="175" src="https://www.youtube.com/embed/<?=$video->link?>"></iframe>
    <?php endforeach; ?>
</div>
<?php
