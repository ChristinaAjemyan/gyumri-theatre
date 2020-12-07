<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Archive */

$this->title = 'Create Archive';
$this->params['breadcrumbs'][] = ['label' => 'Archives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'model_image' => $model_image,
        'model_archive_perform' => $model_archive_perform
    ]) ?>

</div>

<?php
$js = <<<JS
$('.file-drop-zone').css('min-height', '202px');
    $('#archive-avatar_image').on('click', function() {
        let footer_none = setInterval(function() {
            if ($('.file-thumbnail-footer').length === 1 && $('.file-thumbnail-footer').attr('style') !== 'display: none;'){
                $('.file-thumbnail-footer').css('display', 'none');
                setTimeout(function() {
                  clearInterval(footer_none);
                }, 1500);
            }
        }, 30);
    })
JS;
$this->registerJs($js);
?>