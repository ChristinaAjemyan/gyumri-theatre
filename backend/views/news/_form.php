<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
                        'options' => ['rows' => 6],
                        'preset' => 'advanced',
                        'clientOptions' => [
                            'filebrowserUploadUrl' => 'img/*'
                        ]
                    ]) ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'uploads/*'],
                    'pluginOptions' => [
                        'initialPreview'=>[
                            '/uploads/'.Yii::$app->session->get('img_name'),
                        ],
                    'initialPreviewAsData'=>true,
                    'initialCaption'=>Yii::$app->session->get('img_name'),
                    'showUpload' => false
                    ]
                ]) ?>

    <?= $form->field($model, 'dt_create')->textInput(['class' => 'datepicker-here form-control', 'data-timepicker' => 'true', 'data-date-format' => 'yyyy-mm-dd']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
