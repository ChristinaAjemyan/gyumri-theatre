<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\WLanguage;
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="d-md-flex flex-row-reverse">
    <div class="signin-right">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="signin-box signup">
            <h3 class="signin-title-primary"><?= Yii::t('label','Get Started')?>!</h3>
            <h5 class="signin-title-secondary lh-4"><?= Yii::t('label','It\'s free to signup and only takes a second')?>.</h5>
            <div class="row row-xs mg-b-10">
                <div class="col-sm">
                    <?= $form->field($model, 'company_name')->textInput(['autofocus' => false]) ?>
                </div>
                <div class="col-sm">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-sm mg-t-10 mg-sm-t-0">
                    <label class="control-label" for="signupform-phone"><?= Yii::t('label','Language')?></label>
                    <?= WLanguage::widget() ?>
                </div>
            </div><!-- row -->
            <div class="row row-xs mg-b-10">
                <div class="col-sm">
                <?= $form->field($model, 'first_name')->textInput(['autofocus' => false]) ?>
                </div>
                <div class="col-sm">
                    <?= $form->field($model, 'last_name')->textInput(['autofocus' => false]) ?>
                </div>
                <div class="col-sm mg-t-10 mg-sm-t-0">
                    <?= $form->field($model, 'phone')->textInput(['autofocus' => false]) ?>

                </div>
            </div><!-- row -->

            <div class="row row-xs mg-b-10">
                <div class="col-sm">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
                <div class="col-sm mg-t-10 mg-sm-t-0">
                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                </div>
            </div><!-- row -->
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-block btn-signin', 'name' => 'signup-button']) ?>


<!--            <div class="signup-separator"><span>or signup using</span></div>-->

<!--            <button class="btn btn-facebook btn-block">Sign Up Using Facebook</button>-->
<!--            <button class="btn btn-twitter btn-block">Sign Up Using Twitter</button>-->
<!--         -->
            <p class="mg-t-40 mg-b-0">Already have an account? <a href="site/login">Sign In</a></p>
        </div><!-- signin-box -->
        <?php ActiveForm::end(); ?>
    </div><!-- signin-right -->
    <div class="signin-left">
        <div class="signin-box">
            <h2 class="slim-logo"><a href="index.html">Autotech<span>.</span></a></h2>

            <p>We are excited to launch our new company and product Slim. After being featured in too many magazines to mention and having created an online stir, we know that ThemePixels is going to be big. We also hope to win Startup Fictional Business of the Year this year.</p>

            <p>Browse our site and see for yourself why you need Slim.</p>

            <p><a href="" class="btn btn-outline-secondary pd-x-25">Learn More</a></p>

            <p class="tx-12">&copy; Copyright 2018. All Rights Reserved.</p>
        </div>
    </div><!-- signin-left -->
</div><!-- d-flex -->
