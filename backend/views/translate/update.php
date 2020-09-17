<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Main;
use app\models\Translate;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

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

        <?= $form->field($update_lang[0], '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Title') ?>

        <?= $form->field($update_lang[1], '[1]text')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Content') ?>

    <?php elseif ($table_name == 'staff'): ?>

        <div class="form-row">
            <div class="col">
                <?= $form->field($update_lang[0], "[0]text")->textInput(['maxlength' => true])->label('First Name') ?>

                <?= $form->field($update_lang[1], "[1]text")->textInput(['maxlength' => true])->label('Last Name') ?>
            </div>
            <div class="col">
                <?= $form->field($update_lang[2], "[2]text")->textInput(['maxlength' => true])->label('Country') ?>

                <?= $form->field($update_lang[3], "[3]text")->textInput(['maxlength' => true])->label('City') ?>
            </div>
        </div>

        <?= $form->field($update_lang[4], "[4]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Description') ?>

    <?php elseif ($table_name == 'performance'): ?>

        <div class="form-row">
            <div class="col-6">
                <?= $form->field($update_lang[0], '[0]text')->textInput(['maxlength' => true])->label('Title') ?>

            </div>
            <div class="col-6">
                <?= $form->field($update_lang[1], '[1]text')->textInput(['maxlength' => true])->label('Author') ?>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?= $form->field($update_lang[2], '[2]text')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Short Description'); ?>
            </div>
            <div class="col-12">
                <?= $form->field($update_lang[3], '[3]text')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Description'); ?>
            </div>
        </div>

    <?php else: ?>

        <?= $form->field($update_lang[0], '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Name') ?>

    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
