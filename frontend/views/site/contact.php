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
<div class="site-contact-map position-relative" style="margin-top: 105px;">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d755.1743778474574!2d43.84538578047872!3d40.79066377176147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041fbf2a2fef76f%3A0xa7bf664eae5715b8!2sVardan%20Ajemyan%20Drama%20Theater!5e0!3m2!1sen!2s!4v1602774799615!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <div class="map-button" id="contactBtn" data-toggle="modal" data-target="#contactModal" style="color: white">
        <a>
            <i class="fas fa-map-marker-alt"></i>
        </a>
    </div>

</div>
<section class="section_carousel">
    <div class="container">
        <div class="current_performances"><h2 class="block_title carousel_title mt-3 contact_block_title"><?= Yii::t('home', 'Ընթացիկ ներկայացումներ') ?></h2></div>
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
<div class="modal fade pr-0" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 950px;margin-top: 110px;">

        <div class="modal-content position-relative" style="border-radius: 20px;background: black">
            <button type="button" class="close close_button" style="padding: 7px 12px;background: #ec7532; z-index: 9999" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="all_content" style="border-radius: 20px;background: black">
                <div class="bg-white left_side_cont">
                    <div class="contact_form position-relative">
                        <p align="center" class="h5 font-weight-bold pb-3">Ուղարկեք մեզ հաղորդագրություն</p>
                        <i class="far fa-envelope message_icon"></i>
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true,'placeholder' => Yii::t('home', 'Անուն Ազգանուն')])->label(false) ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('home', 'Էլ-հասցե')])->label(false) ?>

                        <?= $form->field($model, 'phone')->textInput(['placeholder' => Yii::t('home', 'Հեռախոսահամար')])->label(false) ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6,'placeholder' => Yii::t('home', 'Հաղորդագրություն')])->label(false) ?>

                        <?/*= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="d-flex justify-content-end"><div>{image}</div><div>{input}</div></div>',
                        ])->label(false) */?>

<!--                        <div class="form-group">
                            <?/*= Html::submitButton(Yii::t('home','Ուղարկել'), ['class' => 'contact-button', 'name' => 'contact-button']) */?>
                        </div>-->
                        <button type="submit" name="contact-button" class="contact-button contact_button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
                <div class="righ_content" style="width: 35%">
                    <div class="contact_form right_side_contact" style="padding: 45px 40px;">
                        <h3 class="mb-5"><?= Yii::t('home', 'Կապ') ?></h3>
                        <p> <i class="fas fa-map-marker-alt fa-lg ml-1 mr-3" style="color: #515151"></i> <?= Yii::t('home', 'Քաղաք Գյումրի') ?>
                            <br><span><?= Yii::t('home', 'Սայաթ Նովա 4') ?></span>
                        </p>
                        <p> <i class="fas fa-phone-alt fa-lg mr-3" style="color: #515151"></i> 060 381010</p>
                        <p> <i class="fas fa-envelope fa-lg mr-3" style="color: #515151"></i> gyumrytheatre@gmail.com</p>
                        <p> <i class="fas fa-clock fa-lg mr-3" style="color: #515151"></i> <?= Yii::t('home', 'Երկ-ուրբ 9։30 - 7։30 pm') ?></p>
                        <br><br>
                        <ul class="social_icons soc_ic_contact" align="center">
                            <li>
                                <a href="https://www.facebook.com/gyumritheatre/" style="color: #515151;" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/gyumri_theatre/" style="color: #515151;" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" style="color: #515151;"><i class="fab fa-telegram-plane"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="site-contact d-flex">
    <div class="container main_container" style="margin-top: 120px">
        <?php /*if (Yii::$app->session->hasFlash('success')): */?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <h5 class="m-0 p-0 text-success"><strong><?/*= Yii::t('home', Yii::$app->session->getFlash('success')); */?></strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: -3px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php /*elseif (Yii::$app->session->hasFlash('error')): */?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <h5 class="m-0 p-0 text-danger"><strong><?/*= Yii::t('home', Yii::$app->session->getFlash('error')); */?></strong></h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: -3px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php /*endif; */?>
        <div class="d-flex contact">
            <div class="mr-2 w-50">
                <?php /*$form = ActiveForm::begin(['id' => 'contact-form']); */?>

                <?/*= $form->field($model, 'name')->textInput(['autofocus' => true]) */?>

                <?/*= $form->field($model, 'email') */?>

                <?/*= $form->field($model, 'subject') */?>

                <?/*= $form->field($model, 'body')->textarea(['rows' => 6]) */?>

                <?/*= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) */?>

                <div class="form-group">
                    <?/*= Html::submitButton(Yii::t('home','Ուղարկել'), ['class' => 'contact-button', 'name' => 'contact-button']) */?>
                </div>

                <?php /*ActiveForm::end(); */?>
            </div>
            <div class="w-50">

            </div>
        </div>
    </div>


</div>-->