<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Performance */

$this->title = 'Create Performance';
$this->params['breadcrumbs'][] = ['label' => 'Performances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'model_image' => $model_image,
        'model_stf_perform' => $model_stf_perform, 'model_genre_perform' => $model_genre_perform
    ]) ?>

</div>



<?php
$js = <<<JS
$('.file-drop-zone').css('min-height', '202px');
    $('#performance-avatar_image, #performance-banner_image').on('click', function() {
        let footer_none = setInterval(function() {
            $.each($('.file-thumbnail-footer'), function(i, item) {
            if ($(item).length === 1 && $(item).attr('style') !== 'display: none;'){
                $(item).css('display', 'none');
                setTimeout(function() {
                  clearInterval(footer_none);
                }, 1500);
            }
            })
        }, 30);
    })
JS;
$this->registerJs($js);
?>
