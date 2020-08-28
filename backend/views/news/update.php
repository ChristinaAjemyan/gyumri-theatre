<?php


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Update News: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


                <?php
$js = <<<JS
    let title = $('.file-caption-name').attr('title');
    if (title === 'default.jpg' || title === '1 file selected') {
        $('.fileinput-remove-button').css('display', 'none');
    }
    $('.fileinput-remove-button').on('click', function() {
        $.ajax({
            url: window.location.href,
            type: 'post'
        })
    })
JS;
$this->registerJs($js);
?>
        