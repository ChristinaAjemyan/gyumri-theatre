<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PerformanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="performance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'img_path') ?>

    <?= $form->field($model, 'staff_id') ?>

    <?= $form->field($model, 'show_date') ?>

    <?php // echo $form->field($model, 'trailer') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>