<?php

use app\models\Main;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use mihaildev\elfinder\ElFinder;
use app\models\Role;
//\mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'role_id')->dropDownList(
                    ArrayHelper::map(Role::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Անձնակազմ...']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date_of_birth')->textInput(['class' => 'datepicker-here form-control', 'data-date-format' => 'yyyy-mm-dd']) ?>

            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'avatar_image')->widget(FileInput::classname(), [
                'options' => ['accept' => 'avatars/*'],
                'pluginOptions' => [
                    'initialPreview' => Main::getInitialPreview($model->attributes['id'], $model),
                    'initialPreviewAsData' => true,
                    'showUpload' => false
                ]
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
