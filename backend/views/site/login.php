<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="signin-wrapper">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<!--    --><?php //use common\widgets\WLanguage; ?>

    <div class="signin-box">
<!--        --><?//= WLanguage::widget() ?>
        <h2 class="slim-logo"><?= Html::a(Html::img(Url::to('/image/logo.png')), Url::base())  ?></h2>
        <h3 class="signin-title-secondary"><?=Yii::t('label','Sign in to continue');?></h3>
        <div class="form-group">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        </div><!-- form-group -->
        <div class="form-group mg-b-50">
            <?= $form->field($model, 'password')->passwordInput() ?>
        </div><!-- form-group -->
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-signin', 'name' => 'login-button']) ?>
    </div><!-- signin-box -->
    <?php ActiveForm::end(); ?>

</div><!-- signin-wrapper -->
