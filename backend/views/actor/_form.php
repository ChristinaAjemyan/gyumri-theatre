<?php

use app\models\Main;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use mihaildev\elfinder\ElFinder;
//\mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Actor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput(['class' => 'datepicker-here form-control', 'data-date-format' => 'yyyy-mm-dd']) ?>

    <?= $form->field($model, 'avatar_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'avatars/*'],
        'pluginOptions' => [
            'initialPreview' => Main::getInitialPreview($model->attributes['id'], $model),
            'initialPreviewAsData' => true,
            'showUpload' => false
        ]
    ]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
