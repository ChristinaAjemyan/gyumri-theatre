<?php

use common\models\ArchiveImage;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use common\models\Main;

/* @var $this yii\web\View */
/* @var $model common\models\Archive */

$this->title = Main::uppercaseFirstLetter($model->title);
$this->params['breadcrumbs'][] = ['label' => 'Archives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$column[] = $column_name[1];
$column[] = $column_name[2];
?>
<div class="archive-view">
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
                'value' =>('<img src =' .'/upload/avatars/archive/200/' . $model->img_path . '>')
            ],
            //'id',
            [
                'attribute' => 'title',
                'value' => Main::uppercaseFirstLetter($model->title)
            ],
            [
                'attribute' => 'Galleries',
                'format' => 'html',
                'value' => function ($model) {
                    $images = ArchiveImage::find()->where(['archive_id' => $model->id])->asArray()->all(); ?>
                    <?php if (!empty($images) && isset($images)): ?>
                        <?php $result = "<div class=\"card border-0\">
                            <div class=\"card-body p-0\">"; ?>
                        <?php foreach ($images as $image): ?>
                            <?php $image = $image['image']; ?>
                            <?php $result .= "<div class=\"\">
                                        <div class=\"card card-block my-block float-left m-2\">
                                            <img src=\"/upload/galleries/250/$image\" alt=\"$image\" style=\"height: 200px;\">
                                        </div>
                                    </div>"; ?>
                        <?php endforeach; ?>
                        <?php $result .= "</div>
                        </div>"; ?>
                    <?php endif; ?>
                    <?php
                    return $result;
                }
            ],
            'content:html',
            //'img_path',
            [
                'attribute' => 'active season',
                'value' => function ($data){
                    return $data->active_season == 1 ? 'YES' : 'NO';
                }
            ],
            'dt_create',
        ],
    ]) ?>

</div>