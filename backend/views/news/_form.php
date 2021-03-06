<?php

use common\models\Main;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
//\mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'videolink')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'show_type')->dropDownList(['1' => 'Videos', '2' => 'Articles',], ['prompt' => 'Select where show.']);?>
            <?= $form->field($model, 'reference_source')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'source_url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'avatar_image')->fileInput(['class' => 'imageFile']) ?>
            <?php if (isset($result)) : ?>
            <?= $result ? $result : false; ?>
            <?php endif; ?>
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