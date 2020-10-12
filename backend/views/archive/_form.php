<?php

use common\models\Main;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Archive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archive-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'avatar_image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'avatars/*'],
                'pluginOptions' => [
                    'initialPreview' => Main::getInitialPreview($model->attributes['id'], $model, 'avatars/archive/200')[0],
                    'initialPreviewAsData' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>