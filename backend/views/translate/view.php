<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Translate */

$this->title = 'Translate confirmed!';
$this->params['breadcrumbs'][] = ['label' => 'Translates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="translate-view">

    <h1 class="text-success">Translate confirmed!</h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'table_name',
            //'column_name',
            //'language',
            //'text:ntext',
            //'table_id',
        ],
    ]) ?>

</div>
