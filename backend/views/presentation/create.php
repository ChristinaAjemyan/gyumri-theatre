<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */

$this->title = 'Create Presentation';
$this->params['breadcrumbs'][] = ['label' => 'Presentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presentation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'model_image' => $model_image, 'model_act_present' => $model_act_present
    ]) ?>

</div>



<?php
$js = <<<JS
$('.file-drop-zone').css('min-height', '202px');
    $('#presentation-avatar_image').on('click', function() {
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
