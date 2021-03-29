<style>
    .help-block-error{
        color: darkred;
    }
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use common\models\Performance;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

?>
<div id="asdasd" data-target=""></div>
<div id="myMap" class="site-contact-map" style="margin-top: 97px; width: 100%; height: 50vh">
<!--    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d755.1743778474574!2d43.84538578047872!3d40.79066377176147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041fbf2a2fef76f%3A0xa7bf664eae5715b8!2sVardan%20Ajemyan%20Drama%20Theater!5e0!3m2!1sen!2s!4v1602774799615!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
</div>

<section class="section_carousel">
    <div class="container position-relative">
        <div class="map-button" id="contactBtn" data-toggle="modal" style="color: white">
            <a>
                <i class="fas fa-map-marker-alt"></i>
            </a>
        </div>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <h5 class="m-0 p-0 text-success"><strong><?= Yii::t('home', Yii::$app->session->getFlash('success')); ?></strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: -3px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <h5 class="m-0 p-0 text-danger"><strong><?= Yii::t('home', Yii::$app->session->getFlash('error')); ?></strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: -3px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="current_performances">
            <h2 class="block_title carousel_title mt-3 contact_block_title" style="padding-top: 120px;"><?= Yii::t('home', 'Ընթացիկ ներկայացումներ') ?></h2>
            <div class="block_title_gred_line"></div>
        </div>
        <span class="title_line" style="margin-top: -25px;"></span>
        <div class="main_carousel owl-carousel" id="current_performance">
            <?php if (!empty($performances) && isset($performances)): ?>
                <?php foreach ($performances as $item): ?>
                    <div class="carousel_item">
                        <div class="card" style="width: 16rem;">
                            <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                                <img class="big-carousel card-img-top" src="<?= Yii::$app->params['backend-url'].'/upload/avatars/performance/400/'.$item->img_path; ?>" alt="image">
                            </a>
                            <div class="card-body">
                                <a href="<?= Url::to(['/performance/view', 'slug' => Yii::t('text', $item->slug)]); ?>">
                                    <h5 class="card-title"><?= Yii::t('text', $item->title); ?></h5>
                                </a>
                                <p class="card-text"><?= Performance::getPerformanceTime($item->show_date); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

</section>
<div class="modal modal_main fade pr-0" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: hidden;">

    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1090px;margin-top: 10px;">

        <div class="modal-content position-relative" style="border-radius: 20px;background: black;border: none;box-shadow:-2px 2px 23px -7px rgb(168 168 168);">
            <button type="button" class="close close_button" style="padding: 9px 14px;background-image: linear-gradient(to right, #F0B866, #DB7439); z-index: 9999" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="all_content" style="border-radius: 20px;background: black">
                <div class="bg-white left_side_cont">
                    <div class="contact_form position-relative">
                        <p align="center" style="font-family: sans-serif;" class="h4 font-weight-bold pb-3"><?= Yii::t('home', 'Ուղարկեք մեզ հաղորդագրություն') ?></p>
                        <!--<i class="far fa-envelope message_icon"></i>-->
                        <img class="message_icon" src="<?= Yii::$app->params['frontend-url'].'/assets/images/let.svg'?>" alt="">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true,'placeholder' => Yii::t('home', 'Անուն Ազգանուն')])->label(false) ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('home', 'Էլ-հասցե')])->label(false) ?>

                        <?= $form->field($model, 'phone')->textInput(['placeholder' => Yii::t('home', 'Հեռախոսահամար')])->label(false) ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6,'placeholder' => Yii::t('home', 'Հաղորդագրություն')])->label(false) ?>

                        <button type="submit" name="contact-button" class="contact-button contact_button">
                            <img src="<?= Yii::$app->params['frontend-url'].'/assets/images/location.svg'?>" alt="">
                        </button>
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
                <div class="righ_content" style="width: 35%">
                    <div class="contact_form right_side_contact" style="padding: 45px 40px;">
                        <h3 class="mb-5"><?= Yii::t('home', 'Կապ') ?></h3>
                        <p> <i class="fas fa-map-marker-alt ml-1" style="color: #515151;font-size: 22px;margin-bottom: -5px;margin-right: 13px;"></i> <?= Yii::t('home', 'Քաղաք Գյումրի') ?>
                            <br><span><?= Yii::t('home', 'Սայաթ Նովա 4') ?></span>
                        </p>
                        <p> <img class="mr-3" src="<?= Yii::$app->params['frontend-url'].'/assets/images/phone.svg'?>" alt="">060 381010</p>
                        <p> <img class="mr-3" src="<?= Yii::$app->params['frontend-url'].'/assets/images/message.svg'?>" alt="">gyumrytheatre@gmail.com</p>
                        <p> <img class="mr-3" src="<?= Yii::$app->params['frontend-url'].'/assets/images/days.svg'?>" alt=""><?= Yii::t('home', 'Երկ-ուրբ 9։30 - 7։30 pm') ?></p>
                        <br><br>
                        <ul class="social_icons soc_ic_contact" align="center">
                            <li>
                                <a href="https://www.facebook.com/gyumritheatre/" style="color: #515151;font-size: 25px;" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/gyumri_theatre/" style="color: #515151;font-size: 25px;" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" style="color: #515151;font-size: 25px;"><i class="fab fa-telegram-plane"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" style="color: #515151;font-size: 25px;"><i class="fab fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$js = <<<JS
    

$(function() {
    $( document ).ready(function() {
      $('#contactModal').modal();
      $('#myMap').css('transition','.5s');
      $('#contactModal').css('transition','.5s');
      $('.contact_block_title').css('padding-top','130px')
    })
    $('#contactBtn').on('click',function() {
        $('#contactModal').modal();
        $('.contact_block_title').css('padding-top','130px')
    })
    $(window).scroll(function(){
        $('#contactModal').modal('hide');
        $('#myMap').css('height','90vh');
        $('.contact_block_title').css('padding-top','25px')
    });
    /*$(window).on('click',function(){
        $('#contactModal').modal('hide');
        $('#myMap').css('height','90vh');
        $('#myMap').css('transition','.5s');
        $('.contact_block_title').css('padding-top','65px')
    });*/
    $('.close_button').on('click',function() {
      $('#myMap').css('height','90vh');
      $('.contact_block_title').css('padding-top','25px')

    })
    $('#contactBtn').on('click',function() {
        $("html, body").animate({ scrollTop: 0 });
        setTimeout(function() {
           $('#myMap').css('height','50vh')
           $('.contact_block_title').css('padding-top','130px')
        },500)
    })
});

JS;
$this->registerJs($js);
?>