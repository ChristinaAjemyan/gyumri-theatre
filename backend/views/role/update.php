<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = 'Update Role: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$a = \app\models\Translate::find()->where(['table_id' => $model->id, 'table_name' => 'role', 'language' => 'ru'])->asArray()->one()['id'];
if ($a){
    $k = "&id=$a";
}else{
    $k = '';
}
//echo '<pre>';
//var_dump($a);
?>
<div class="role-update">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5">
            <?= Html::a('HY', "?id=$model->id"); ?>
            <?= Html::a('RU', "/role/translate?lang=ru$k"); ?>
            <?= Html::a('EN', "/role/translate?lang=en&id=$model->id"); ?>
        </div>
    </div>


    <?= $this->render('_form', [
        'model' => $model, 'model_translate' => $model_translate
    ]) ?>

</div>
