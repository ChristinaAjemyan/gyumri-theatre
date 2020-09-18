<?php

use common\models\Main;
use common\models\Role;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\StaffImage;

/* @var $this yii\web\View */
/* @var $model common\models\Staff */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$table_name = $model->tableName();
$column_name = array_keys($model->attributes);
$arrColumnName = "column_name[]=$column_name[1]&column_name[]=$column_name[2]&column_name[]=$column_name[5]&column_name[]=$column_name[6]&column_name[]=$column_name[7]";
?>
<div class="staff-view">

    <div class="d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="mt-5 mr-5 language_flag_disabled">
            <?= Html::a(Html::img(Url::to('/image/flag_am.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_am']), "/$table_name/update?id=$model->id"); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_ru.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_ru']), Main::createTranslationUrlRU($table_name, $model->id, $arrColumnName)); ?>
            <?= Html::a(Html::img(Url::to('/image/flag_en.png'), ['style' => 'width:30px; height:25px;', 'class' => 'flag_en']), Main::createTranslationUrlEN($table_name, $model->id, $arrColumnName)); ?>
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
                'value' =>('<img src =' .'/upload/avatars/staff/400/' . $model->img_path . ' width="300"' .   '>')
            ],
            //'id',
            'first_name',
            'last_name',
            [
                'attribute' => 'role',
                'value' => Role::find()->where(['id' => $model->role_id])->asArray()->one()['name']
            ],
            'date_of_birth',
            //'img_path',
            'country',
            'city',
            [
                'attribute' => 'Galleries',
                'format' => 'html',
                'value' => function ($model) {
                    $images = StaffImage::find()->where(['staff_id' => $model->id])->asArray()->all(); ?>
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
            'desc:html',
        ],
    ]) ?>

</div>
