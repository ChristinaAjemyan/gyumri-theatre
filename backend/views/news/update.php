<?php


use yii\helpers\Html;
use app\models\Main;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Update News: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';


$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$arrColumnName = "column_name[]=$column_name[1]&column_name[]=$column_name[2]";

?>
<div class="news-update">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5">
            <?= Html::a('HY', "?id=$model->id"); ?>
            <?= Html::a('RU', Main::createTranslationUrlRU($table_name, $model->id, $arrColumnName)); ?>
            <?= Html::a('EN', Main::createTranslationUrlEN($table_name, $model->id, $arrColumnName)); ?>
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
