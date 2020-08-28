<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use app\models\Actor;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
function getFullName()
{
    $key = [];
    $val = [];
    $fist_name = ArrayHelper::map(Actor::find()->all(), 'id', 'first_name');
    $last_name = ArrayHelper::map(Actor::find()->all(), 'id', 'last_name');
    for ($i = 1, $j = 1; $i <= count($fist_name), $j <= count($last_name); $i++, $j++) {
        $fullName = $fist_name[$i] . ' ' . $last_name[$j];
        array_push($key, $i);
        array_push($val, $fullName);
        $result = array_combine($key, $val);
    }
    return $result;
}

?>

<div class="presentation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'uploads/*'],
        'pluginOptions' => [
            'initialPreview' => [
                '/uploads/' . Yii::$app->session->get('img_name'),
            ],
            'initialPreviewAsData' => true,
            'initialCaption' => Yii::$app->session->get('img_name'),
            'showUpload' => false
        ]
    ]) ?>

    <?= $form->field($model, 'actors_id')->widget(Select2::className(), [
        'data' => getFullName(),
        'options' => [
            'placeholder' => 'Select actors ...',
            'multiple' => true
        ],
    ]) ?>

    <?= $form->field($model, 'show_date')->textInput(['class' => 'datepicker-here form-control', 'data-timepicker' => 'true', 'data-date-format' => 'yyyy-mm-dd']) ?>

    <?= $form->field($model, 'trailer')->textInput(['maxlength' => true]) ?>

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
