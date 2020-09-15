<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<div class="d-flex justify-content-between">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="mt-5 mr-5">
        <?= Html::a('HY', "?id=8"); ?>
        <?= Html::a('RU', "/role/translate?lang=ru&id=$model_translate->id"); ?>
        <?= Html::a('EN', "/role/translate?lang=en&id=$model_translate->id"); ?>
    </div>
</div>

<div class="role-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model_translate, 'text')->textInput(['maxlength' => true, 'style' => 'width:35%']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
