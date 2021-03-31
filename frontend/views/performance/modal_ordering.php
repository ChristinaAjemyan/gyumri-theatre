<?php

use common\models\Performance;
use frontend\controllers\TicketController;
?>
<div class="modal modal_main fade pr-0" id="orderingModal_index" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">

    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 702px;margin-top: 2%;">

        <div class="modal-content position-relative text-white" style="border-radius: 20px;background: black;border: none;box-shadow:-2px 2px 23px -7px rgb(168 168 168);">
            <button type="button" class="close close_button" style="padding: 9px 14px;background-image: linear-gradient(to right, #F0B866, #DB7439);right: 23px; z-index: 9999" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php if (isset($_GET['id'])) : ?>
<!--                $_GET['external_order_id']?$_GET['external_order_id']:false,$_GET['order_id']?$_GET['order_id']:false-->
                <?php $timelines = Performance::openModal($_GET['id']); ?>
                <h3 class="new_section-title mb-0">«<?= $timelines->data[0]->name ?>»</h3>
                <div class="ordering_content">
                <?php foreach ($timelines->data as $item) : ?>
                <?php foreach ($item->timeline as $val) : ?>
                    <div class="d-flex position-relative mb-2">
                        <?=$val->time?>
                        <button class="btn btn-sm ordering_button" style="background: linear-gradient(to right, #fab144, #ec7532);" data-openticket="<?=$val->id?>"><?= Yii::t('home', 'ՊԱՏՎԻՐԵԼ') ?></button>
                    </div>
                <?php endforeach; ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?=$timelines->script?>

<?php
$js = <<<JS
    $('.ordering_button').on('click',function() {
        $(document).off("focusin");
        $(document).off("focus");
    });   
    $('.hy_timeline br').remove();
    $('.hy_timeline').css('font-size','14px');
    $(function() {
            $(window).scroll(function(){
        $('.close_button').click();
    });
    })
JS;
$this->registerJs($js);
?>
