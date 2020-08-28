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
        'model' => $model,
    ]) ?>

</div>



            <?php
$js = <<<JS
    let title = $('.file-caption-name').attr('title');
    if (title === '1 file selected') {
        $('.fileinput-remove-button').css('display', 'none');
    }
JS;
$this->registerJs($js);
?>
                        