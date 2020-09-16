<?php

use yii\helpers\Html;
use app\models\Main;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = 'Update Role: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$arrColumnName = "column_name[]=$column_name[1]";
?>
<div class="role-update">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5">
            <?= Html::a('HY', "?id=$model->id"); ?>
            <?= Html::a('RU', Main::createTranslationUrlRU($table_name, $model->id, $arrColumnName)); ?>
            <?= Html::a('EN', Main::createTranslationUrlEN($table_name, $model->id, $arrColumnName)); ?>
        </div>
    </div>


    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
