<style>
    .help-block-error{
        color: darkred;
    }
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>

<div class="site-contact d-flex">
    <div class="container main_container" style="margin-top: 120px">
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
        <div class="d-flex mb-4">
            <h2 class="title-type mb-0"><?= Html::encode($this->title) ?></h2>
            <div class="title-side-line"></div>
        </div>
        <div class="d-flex contact">
            <div class="mr-2 w-50">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('home','Ուղարկել'), ['class' => 'contact-button', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="w-50">
                <div class="site-contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d755.1743778474574!2d43.84538578047872!3d40.79066377176147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4041fbf2a2fef76f%3A0xa7bf664eae5715b8!2sVardan%20Ajemyan%20Drama%20Theater!5e0!3m2!1sen!2s!4v1602774799615!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>


</div>