<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Main;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model common\models\Role */

$id = Yii::$app->request->get('id');
$table_name = Yii::$app->request->get('table_name');
$column_name = Yii::$app->request->get('col');
$lang = Yii::$app->request->get('lang');

$this->title = 'Update the translation of '.ucfirst($table_name).': ' . $update_lang[0]->translation;
$this->params['breadcrumbs'][] = 'Update';?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
        <h3 class="m-0 p-0 text-success"><strong><?= Yii::$app->session->getFlash('success'); ?></strong></h3>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top: -32px">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php

foreach ($column_name as $item){
    $column[] = $item;
}

?>

<div class="translate-update">
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

        <?= $form->field($update_lang[0], '[0]translation')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Title') ?>

        <?= $form->field($update_lang[1], '[1]translation')->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Content') ?>

    <?php elseif ($table_name == 'staff'): ?>

        <div class="form-row">
            <div class="col">
                <?= $form->field($update_lang[0], "[0]translation")->textInput(['maxlength' => true])->label('First Name') ?>

                <?= $form->field($update_lang[1], "[1]translation")->textInput(['maxlength' => true])->label('Last Name') ?>

                <?= $form->field($update_lang[2], "[2]translation")->textInput(['maxlength' => true])->label('Slug') ?>
            </div>
            <div class="col">
                <?= $form->field($update_lang[3], "[3]translation")->textInput(['maxlength' => true])->label('Genre') ?>

                <?= $form->field($update_lang[4], "[4]translation")->textInput(['maxlength' => true])->label('Country') ?>

                <?= $form->field($update_lang[5], "[5]translation")->textInput(['maxlength' => true])->label('City') ?>
            </div>
        </div>

        <?= $form->field($update_lang[6], "[6]translation")->widget(CKEditor::className(), [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
        ])->label('Description') ?>

    <?php elseif ($table_name == 'performance'): ?>

        <div class="form-row">
            <div class="col-6">
                <?= $form->field($update_lang[0], '[0]translation')->textInput(['maxlength' => true])->label('Title') ?>

                <?= $form->field($update_lang[1], "[1]translation")->textInput(['maxlength' => true])->label('Slug') ?>
            </div>
            <div class="col-6">
                <?= $form->field($update_lang[2], '[2]translation')->textInput(['maxlength' => true])->label('Author') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?= $form->field($update_lang[3], '[3]translation')->textarea(['rows' => 6])->label('Short Description'); ?>
            </div>
            <div class="col-12">
                <?= $form->field($update_lang[4], '[4]translation')->widget(CKEditor::className(), [
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
                ])->label('Description'); ?>
            </div>
        </div>

    <?php else: ?>

        <?= $form->field($update_lang[0], '[0]translation')->textInput(['maxlength' => true, 'style' => 'width:35%'])->label('Name') ?>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
