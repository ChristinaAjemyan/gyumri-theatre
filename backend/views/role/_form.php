<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */

//var_dump(Yii::$app->request->get('lang'));
?>

<div class="role-form">

<!--    <?php /*if (Yii::$app->request->get('lang')): */?>

        <?php /*$form = ActiveForm::begin(); */?>

        <?/*= $form->field($model_translate, 'text')->textInput(['maxlength' => true, 'style' => 'width:35%']) */?>

        <div class="form-group">
            <?/*= Html::submitButton('Save', ['class' => 'btn btn-success']) */?>
        </div>

        <?php /*ActiveForm::end(); */?>

    --><?php /*else: */?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'style' => 'width:35%']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

<!--    --><?php /*endif; */?>



</div>
