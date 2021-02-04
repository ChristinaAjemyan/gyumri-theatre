<?php

use common\models\Main;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Staff;
use common\models\StaffPerformance;
use common\models\Image;

/* @var $this yii\web\View */
/* @var $model common\models\Performance */

$this->title = Main::uppercaseFirstLetter($model->title);
$this->params['breadcrumbs'][] = ['label' => 'Performances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$column[] = $column_name[1];
$column[] = $column_name[13];
$column[] = $column_name[8];
$column[] = $column_name[10];
$column[] = $column_name[11];
?>
<div class="performance-view">

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
                'value' => ('<img src =' . '/upload/avatars/performance/original/' . $model->img_path . ' width="300"' . '>')
            ],
            //'id',
            [
                'attribute' => 'title',
                'value' => Main::uppercaseFirstLetter($model->title)
            ],
            'slug',
            //'img_path',
            [
                'attribute' => 'staff',
                'format' => 'html',
                'value' => function ($model) {
                    $result = "";
                    $arr = [];
                    $staff = StaffPerformance::find()->where(['performance_id' => $model->id])->asArray()->all();
                    foreach ($staff as $item) {
                        $first_name = Staff::find()->where(['id' => $item['staff_id']])->asArray()->all()[0]['first_name'];
                        $last_name = Staff::find()->where(['id' => $item['staff_id']])->asArray()->all()[0]['last_name'];
                        $arr[$item['staff_id']] = Main::uppercaseNames($first_name).' '.Main::uppercaseNames($last_name);
                    }
                    foreach ($arr as $key => $value) {
                        $result .= Html::a($value, "/staff/view?id=$key", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold']) . " ";
                    }
                    return $result;
                }
            ],
            [
                'attribute' => 'banner',
                'format' => 'html',
                'value' => ('<img src =' . '/upload/banners/' . $model->banner ? $model->banner : '' . ' width="300"' . '>')
            ],
            'show_date',
            'trailer',
            [
                'attribute' => 'Galleries',
                'format' => 'html',
                'value' => function ($model) {
                    $images = Image::find()->where(['performance_id' => $model->id])->asArray()->all(); ?>
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
            'age_restriction',
            'performance_length',
            [
                'attribute' => 'author',
                'value' => Main::uppercaseNames($model->author)
            ],
            [
                'attribute' => 'hall',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->hall == 0 ? 'Մեծ թատրոն' : $model->hall == 1 ? 'Փոքր թատրոն' : 'Հյուրախաղ';
                }
            ],
            'short_desc:html',
            'desc:html',
            [
                'attribute' => 'is_new',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->is_new == 0 ? '' : 'Շուտով';
                }
            ],
        ],

    ]) ?>
</div>