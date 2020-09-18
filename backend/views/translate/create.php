<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Main;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use common\models\Translate;
use yii\helpers\Url;
?>

<?php

$table_name = Yii::$app->request->get('table_name');
$column_name = Yii::$app->request->get('column_name');
$lang = Yii::$app->request->get('lang');
$table_id = Yii::$app->request->get('table_id');

$this->title = 'Translate '.ucfirst($table_name);

$arrColumnNameUrl = "";
foreach ($column_name as $item){
    $arrColumnNameUrl .= "&column_name[]=".$item;
}

$arrColumnName = trim($arrColumnNameUrl, '&');

if (Yii::$app->session->has('translate')){
    $isTranslate = Translate::find()->where(['id' => Yii::$app->session->get('translate')])->all();
    if ($isTranslate){
        if ($lang == 'ru'){
            Yii::$app->response->redirect(Main::createTranslationUrlRU($table_name, $table_id, $arrColumnName));
        }else{
            Yii::$app->response->redirect(Main::createTranslationUrlEN($table_name, $table_id, $arrColumnName));
        }
        unset($_SESSION['translate']);
    }
}
?>

<div class="translate-create">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "/$table_name/update?id=$table_id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($table_name, $table_id, $arrColumnName)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($table_name, $table_id, $arrColumnName)); ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($table_name == 'news'): ?>

        <?= $form->field($translate, "[0]text")->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Title') ?>

        <?= $form->field($translate, "[1]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Content'); ?>


    <?php elseif ($table_name == 'staff'): ?>

        <div class="form-row">
            <div class="col">
                <?= $form->field($translate, "[0]text")->textInput(['maxlength' => true])->label('First Name') ?>

                <?= $form->field($translate, "[1]text")->textInput(['maxlength' => true])->label('Last Name') ?>
            </div>
            <div class="col">
                <?= $form->field($translate, "[2]text")->textInput(['maxlength' => true])->label('Country') ?>

                <?= $form->field($translate, "[3]text")->textInput(['maxlength' => true])->label('City') ?>
            </div>
        </div>

        <?= $form->field($translate, "[4]text")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Description') ?>

    <?php elseif ($table_name == 'performance'): ?>

        <div class="form-row">
            <div class="col-6">
                <?= $form->field($translate, '[0]text')->textInput(['maxlength' => true])->label('Title') ?>

            </div>
            <div class="col-6">
                <?= $form->field($translate, '[1]text')->textInput(['maxlength' => true])->label('Author') ?>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?= $form->field($translate, '[2]text')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Short Description'); ?>
            </div>
            <div class="col-12">
                <?= $form->field($translate, '[3]text')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Description'); ?>
            </div>
        </div>

    <?php else: ?>

        <?= $form->field($translate, '[0]text')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Name') ?>

    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
