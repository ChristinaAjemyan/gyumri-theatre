<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Main;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;
use app\models\Role;
?>

<?php
$table_name = Yii::$app->request->get('table_name');
$column_name = Yii::$app->request->get('column_name');
$table_id = Yii::$app->request->get('table_id');

$this->title = 'Create '.ucfirst($table_name);

$arrColumnNameUrl = "";
foreach ($column_name as $item){
    $arrColumnNameUrl .= "&column_name[]=".$item;
}
$arrColumnName = trim($arrColumnNameUrl, '&');
?>



<div class="translate-create">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5">
            <?= Html::a('HY', "/$table_name/update?id=$table_id"); ?>
            <?= Html::a('RU', Main::createTranslationUrlRU($table_name, $table_id, $arrColumnName)); ?>
            <?= Html::a('EN', Main::createTranslationUrlEN($table_name, $table_id, $arrColumnName)); ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($table_name == 'news'): ?>

        <?= $form->field($translate, "[0]text")->textInput(['maxlength' => true]) ?>

        <?= $form->field($translate, "[1]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]); ?>


    <?php elseif ($table_name == 'staff'): ?>

        <?= $form->field($translate, "[0]text")->textInput(['maxlength' => true])->label('First Name') ?>

        <?= $form->field($translate, "[1]text")->textInput(['maxlength' => true])->label('Last Name') ?>

        <?= $form->field($translate, "[2]text")->dropDownList(
            ArrayHelper::map(Role::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Անձնակազմ...'])->label('Role Id') ?>

        <?= $form->field($translate, "[3]text")->textInput(['maxlength' => true])->label('Country') ?>

        <?= $form->field($translate, "[4]text")->textInput(['maxlength' => true])->label('City') ?>

        <?= $form->field($translate, "[5]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Description') ?>

    <?php elseif ($table_name == 'performance'): ?>


    <?php else: ?>

        <?= $form->field($translate, '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%', 'required'=>true]) ?>

    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
