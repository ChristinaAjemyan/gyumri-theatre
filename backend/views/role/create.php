<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = 'Create Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5">
            <?= Html::a('HY', '/'.Yii::$app->request->pathInfo); ?>
            <?= Html::a('RU', "?lang=ru"); ?>
            <?= Html::a('EN', "?lang=en"); ?>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model, 'model_translate' => $model_translate
    ]) ?>

</div>
