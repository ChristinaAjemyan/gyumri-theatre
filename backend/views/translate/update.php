<?php

use app\models\Role;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Main;
use app\models\Translate;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Role */


$table_name = Yii::$app->request->get('table_name');
$column_name = Yii::$app->request->get('column_name');
$table_id = Yii::$app->request->get('table_id');
$lang = Yii::$app->request->get('lang');
$name = Translate::find()->where(['table_id' => $table_id, 'table_name' => $table_name, 'language' => $lang])->one();


$this->title = 'Update '.ucfirst($table_name).': ' . $name->text;
$this->params['breadcrumbs'][] = 'Update';

$arrColumnNameUrl = "";
foreach ($column_name as $item){
    $arrColumnNameUrl .= "&column_name[]=".$item;
}
$arrColumnName = trim($arrColumnNameUrl, '&');
?>


<div class="translate-update">

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

        <?= $form->field($update_translate, "[0]text")->textInput(['maxlength' => true]) ?>

        <?= $form->field($update_translate, "[1]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ]); ?>

    <?php elseif ($table_name == 'staff'): ?>

        <?= $form->field($update_translate, "[0]text")->textInput(['maxlength' => true])->label('First Name') ?>

        <?= $form->field($update_translate, "[1]text")->textInput(['maxlength' => true])->label('Last Name') ?>

        <?= $form->field($update_translate, "[2]text")->dropDownList(
            ArrayHelper::map(Role::find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Անձնակազմ...'])->label('Role Id') ?>

        <?= $form->field($update_translate, "[3]text")->textInput(['maxlength' => true])->label('Country') ?>

        <?= $form->field($update_translate, "[4]text")->textInput(['maxlength' => true])->label('City') ?>

        <?= $form->field($update_translate, "[5]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Description') ?>

    <?php elseif ($table_name == 'performance'): ?>

    <?php else: ?>

        <?= $form->field($update_translate, '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%', 'required'=>true]) ?>

    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
