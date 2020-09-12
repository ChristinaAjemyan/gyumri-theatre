<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Staff;
use app\models\StaffPerformance;
use app\models\Image;

/* @var $this yii\web\View */
/* @var $model app\models\Performance */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Performances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="performance-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'value' => ('<img src =' . '/upload/avatars/' . $model->img_path . ' width="300"' . '>')
            ],
            //'id',
            'title',
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
                        $arr[$item['staff_id']] = $first_name . ' ' . $last_name;
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
                'value' => ('<img src =' . '/upload/banners/' . $model->banner . ' width="300"' . '>')
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
                                            <img src=\"/upload/galleries/$image\" alt=\"$image\" style=\"height: 200px;\">
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
            'author',
            'hall',
            'short_desc:html',
            'desc:html',
            'is_new'
        ],

    ]) ?>

</div>
