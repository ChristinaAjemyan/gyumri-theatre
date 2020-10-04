<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Main;
use common\models\Translate;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Role */


$table_name = Yii::$app->request->get('table_name');
$column_name = Yii::$app->request->get('col');
$table_id = Yii::$app->request->get('table_id');
$lang = Yii::$app->request->get('lang');
$name = Translate::find()->where(['table_id' => $table_id, 'table_name' => $table_name, 'language' => $lang])->one();


$this->title = 'Update the translation of '.ucfirst($table_name).': ' . $name->text;
$this->params['breadcrumbs'][] = 'Update';
$column = [];
//$arrColumnNameUrl = "";
foreach ($column_name as $item){
    //$arrColumnNameUrl .= "&column_name[]=".$item;
    $column[] = $item;
}
//$arrColumnName = trim($arrColumnNameUrl, '&');
//echo '<pre>';
//var_dump($update_lang);die;
$id = Yii::$app->request->get('id');
?>


<div class="translate-update">
    <h1 class="text-success">Translate confirmed! Update</h1>
    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "/$table_name/update?id=$id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($id, $table_name, $column)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($id, $table_name, $column)); ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

<!--    <?php /*if ($table_name == 'news'): */?>

        <?/*= $form->field($update_lang[0], '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Title') */?>

        <?/*= $form->field($update_lang[1], '[1]text')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Content') */?>

    <?php /*elseif ($table_name == 'staff'): */?>

        <div class="form-row">
            <div class="col">
                <?/*= $form->field($update_lang[0], "[0]text")->textInput(['maxlength' => true])->label('First Name') */?>

                <?/*= $form->field($update_lang[1], "[1]text")->textInput(['maxlength' => true])->label('Last Name') */?>
            </div>
            <div class="col">
                <?/*= $form->field($update_lang[2], "[2]text")->textInput(['maxlength' => true])->label('Country') */?>

                <?/*= $form->field($update_lang[3], "[3]text")->textInput(['maxlength' => true])->label('City') */?>
            </div>
        </div>

        <?/*= $form->field($update_lang[4], "[4]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Description') */?>

    <?php /*elseif ($table_name == 'performance'): */?>

        <div class="form-row">
            <div class="col-6">
                <?/*= $form->field($update_lang[0], '[0]text')->textInput(['maxlength' => true])->label('Title') */?>

            </div>
            <div class="col-6">
                <?/*= $form->field($update_lang[1], '[1]text')->textInput(['maxlength' => true])->label('Author') */?>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?/*= $form->field($update_lang[2], '[2]text')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Short Description'); */?>
            </div>
            <div class="col-12">
                <?/*= $form->field($update_lang[3], '[3]text')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Description'); */?>
            </div>
        </div>

    <?php /*else: */?>

        <?/*= $form->field($update_lang[0], '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Name') */?>

    --><?php /*endif; */?>

    <?= $form->field($update_lang[0], '[0]translation')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Name') ?>

    <?= $form->field($update_lang[1], '[1]translation')->textarea(); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
