<?php

use common\models\Main;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = Main::uppercaseFirstLetter($model->title);
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$column[] = $column_name[1];
$column[] = $column_name[2];
?>
<div class="news-view">
    <div class="d-flex justify-content-between">
        <h1><?= Html::encode(Main::uppercaseFirstLetter($this->title)) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "/$table_name/update?id=$model->id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($model->id, $table_name, $column)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($model->id, $table_name, $column)); ?>
        </div>
    </div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' =>('<img src =' .'/upload/avatars/news/200/' . $model->img_path . '>')
            ],
            //'id',
            [
                'attribute' => 'title',
                'value' => Main::uppercaseFirstLetter($model->title)
            ],
            'content:html',
            //'img_path',
            'dt_create',
        ],
    ]) ?>
</div>