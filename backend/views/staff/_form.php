<?php

use common\models\Main;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;
use common\models\Role;
//\mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model common\models\Staff */
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
                    ArrayHelper::map(Role::find()->orderBy('name')->asArray()->all(), 'id', 'name'), ['prompt' => 'Անձնակազմ...']); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'staff_status')->dropDownList([1=>'administrative',2=>'artistic',3=>'technical'], ['prompt' => '']); ?>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date_of_birth')->textInput(['class' => 'datepicker-here form-control', 'data-date-format' => 'yyyy-mm-dd','autocomplete' => 'off','readonly' => 'readonly']) ?>

            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'inst_url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col">
            <label style="font-weight: lighter;font-size: 11px" class="mt-4 pt-1" for="">Not Required</label>
            <?= $form->field($model, 'primary_key')->checkbox() ?>
            <div class="hidden_desc"><?= $form->field($model, 'index_description')->textarea(['rows' => '6']) ?></div>
            <?= $form->field($model, 'staff_genre_type')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'avatar_image')->fileInput(['class' => 'imageFile']) ?>
            <?php if (isset($result_avatar)) : ?>
            <?= $result_avatar ? $result_avatar : false; ?>
            <?php endif; ?>

        </div>
    </div>

    <?= $form->field($model_image, 'image[]')->fileInput(['multiple' => true])->label('Galleries') ?>

    <?php if (isset($result)) : ?>
        <?= $result ? $result : false; ?>
    <?php endif; ?>

    <?= $form->field($model, 'desc')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <?= $form->field($model, 'is_member')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS

if ($('#staff-primary_key')[0].checked){
    $('.hidden_desc').slideDown();
} 
$('#staff-primary_key').on('change',function() {
    if (this.checked) {
        $('.hidden_desc').slideDown();
    } else {
        $('.hidden_desc').slideUp();
    }
})

JS;
$this->registerJs($js);
?>