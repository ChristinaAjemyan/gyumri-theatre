<?php


use yii\helpers\Html;
use common\models\Main;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = 'Update News: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$column[] = $column_name[1];
$column[] = $column_name[2];
?>
<div class="news-update">
    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "?id=$model->id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($model->id, $table_name, $column)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($model->id, $table_name, $column)); ?>
        </div>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>


<?php
$js = <<<JS
    $('.file-thumbnail-footer').css('display', 'none');
    $('.file-drop-zone').css('min-height', '202px');
    $('#news-avatar_image').on('click', function() {
        let footer_none = setInterval(function() {
            if ($('.file-thumbnail-footer').length === 1 && $('.file-thumbnail-footer').attr('style') !== 'display: none;'){
                $('.file-thumbnail-footer').css('display', 'none');
                setTimeout(function() {
                  clearInterval(footer_none);
                }, 1500);
            }
        }, 30);
    });
JS;
$this->registerJs($js);
?>
