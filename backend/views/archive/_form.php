<?php

use common\models\Main;
use common\models\Performance;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
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

            <?= $form->field($model_archive_perform, 'performance_id')->widget(Select2::className(), [
                'data' => ArrayHelper::map(Performance::find()->all(), 'id', 'title'),
                'options' => [
                    'placeholder' => 'Select performances ...',
                    'multiple' => true
                ],
            ]) ?>

        </div>
        <div class="col-lg-6 col-md-8 col-sm-12">


        </div>
    </div>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <?= $form->field($model_image, 'image[]')->fileInput(['multiple' => true])->label('Galleries') ?>

    <?= $result ? $result : false; ?>

    <?= $form->field($model, 'active_season')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>