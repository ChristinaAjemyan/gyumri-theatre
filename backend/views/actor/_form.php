<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Actor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput(['class' => 'datepicker-here form-control', 'data-date-format' => 'yyyy-mm-dd']) ?>

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

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(),[
                        'options' => ['rows' => 6],
                        'preset' => 'advanced',
                        'clientOptions' => [
                            'filebrowserUploadUrl' => 'img/*'
                        ]
                    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
