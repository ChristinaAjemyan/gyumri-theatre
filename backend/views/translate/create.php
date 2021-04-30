<?php

use common\models\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Main;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\Url;
?>

<?php
$id = Yii::$app->request->get('id');
$table_name = Yii::$app->request->get('table_name');
$column_name = Yii::$app->request->get('col');
$lang = Yii::$app->request->get('lang');

$this->title = 'Translate '.ucfirst($table_name);

foreach ($column_name as $item){
    $column[] = $item;
}

if (Yii::$app->session->has('message') && Yii::$app->session->has('lang')){
    $hasMessage = Message::find()->where(['id' => Yii::$app->session->get('message'), 'language' => Yii::$app->session->get('lang')])->all();
    if ($hasMessage){
        if ($lang == 'ru'){
            Yii::$app->response->redirect(Main::createTranslationUrlRU($id, $table_name, $column));
        }else{
            Yii::$app->response->redirect(Main::createTranslationUrlEN($id, $table_name, $column));
        }
        unset($_SESSION['message']);
        unset($_SESSION['lang']);
    }
}
?>

<div class="translate-create">
    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "/$table_name/update?id=$id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($id, $table_name, $column)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($id, $table_name, $column)); ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($table_name == 'news' || $table_name == 'archive'): ?>

        <?= $form->field($message, "[0]translation")->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Title') ?>

        <?= $form->field($message, "[1]translation")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Content'); ?>

    <?php elseif ($table_name == 'staff'): ?>

        <div class="form-row">
            <div class="col">
                <?= $form->field($message, "[0]translation")->textInput(['maxlength' => true])->label('First Name') ?>

                <?= $form->field($message, "[1]translation")->textInput(['maxlength' => true])->label('Last Name') ?>

                <?= $form->field($message, "[2]translation")->textInput(['maxlength' => true])->label('Slug') ?>

                <?= $form->field($message, "[6]translation")->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Description') ?>
            </div>
            <div class="col">
                <?= $form->field($message, "[3]translation")->textInput(['maxlength' => true])->label('Genre') ?>

                <?= $form->field($message, "[4]translation")->textInput(['maxlength' => true])->label('Country') ?>

                <?= $form->field($message, "[5]translation")->textInput(['maxlength' => true])->label('City') ?>

                <?= $form->field($message, "[7]translation")->textarea(['rows' => 8])->label('Index Description') ?>
            </div>
        </div>

    <?php elseif ($table_name == 'performance'): ?>

        <div class="form-row">
            <div class="col-6">
                <?= $form->field($message, '[0]translation')->textInput(['maxlength' => true])->label('Title') ?>

                <?= $form->field($message, "[1]translation")->textInput(['maxlength' => true])->label('Slug') ?>
            </div>
            <div class="col-6">
                <?= $form->field($message, '[2]translation')->textInput(['maxlength' => true])->label('Author') ?>
            </div>
        </div>


    <?php elseif ( $table_name == 'project'): ?>
        <div class="row">
            <div class="col-12">
                <?= $form->field($message, '[0]translation')->textInput(['maxlength' => true])->label('Title'); ?>
            </div>
            <div class="col-12">
                <?= $form->field($message, '[1]translation')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Description'); ?>
            </div>
        </div>

    <?php else: ?>

        <?= $form->field($message, '[0]translation')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Name') ?>

    <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>