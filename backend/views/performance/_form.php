<?php

use app\models\Performance;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use app\models\Main;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
//\mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Performance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="performance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hall')->radioList([0 =>'Մեծ թատրոն', 1 => 'Փոքր թատրոն'], ['value' => 0]) ?>

    <?= $form->field($model, 'avatar_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'avatars/*'],
        'pluginOptions' => [
            'initialPreview' => Main::getInitialPreview($model->attributes['id'], $model),
            'initialPreviewAsData' => true,
            'showUpload' => false
        ]
    ]) ?>

    <?= $form->field($model_stf_present, 'staff_id')->widget(Select2::className(), [
        'data' => Performance::getFullName(),
        'options' => [
            'placeholder' => 'Select staff ...',
            'multiple' => true
        ],
    ]) ?>

    <?= $form->field($model, 'show_date')->textInput(['class' => 'datepicker-here form-control', 'data-timepicker' => 'true', 'data-date-format' => 'yyyy-mm-dd']) ?>

    <?= $form->field($model, 'trailer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age_restriction')->textInput(['type' => 'number', 'min' => 0]); ?>

    <?= $form->field($model, 'performance_length')->textInput(['type' => 'number', 'min' => 1]); ?>

<!--    --><?//= $form->field($model, 'banner_image')->widget(FileInput::classname(), [
//        'options' => ['accept' => 'banners/*'],
//        'pluginOptions' => [
//            'initialPreview' => Main::getInitialPreview($model->attributes['id'], $model),
//            'initialPreviewAsData' => true,
//            'showUpload' => false
//        ]
//    ]) ?>

    <?= $form->field($model, 'banner_image')->fileInput() ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_image, 'image[]')->fileInput(['multiple' => true]) ?>

    <?= $result ? $result : false; ?>

    <?= $form->field($model, 'short_desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <?= $form->field($model, 'is_new')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
