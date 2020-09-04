<?php

use app\models\Presentation;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use app\models\Main;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presentation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'upload_avatars/*'],
        'pluginOptions' => [
            'initialPreview' => Main::getInitialPreview($model->attributes['id'], $model),
            'initialPreviewAsData' => true,
            'showUpload' => false
        ]
    ]) ?>

    <?= $form->field($model_act_present, 'actor_id')->widget(Select2::className(), [
        'data' => Presentation::getFullName(),
        'options' => [
            'placeholder' => 'Select actors ...',
            'multiple' => true
        ],
    ]) ?>

    <?= $form->field($model, 'show_date')->textInput(['class' => 'datepicker-here form-control', 'data-timepicker' => 'true', 'data-date-format' => 'yyyy-mm-dd']) ?>

    <?= $form->field($model, 'trailer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_image, 'image[]')->fileInput(['multiple' => true]) ?>

    <?= $result ? $result : false; ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advanced',
        'clientOptions' => [
            'filebrowserUploadUrl' => 'img/*'
        ]
    ]) ?>

    <?= $form->field($model, 'is_new')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
