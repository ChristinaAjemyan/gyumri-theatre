<?php

use app\models\Role;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Staff */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="staff-view">

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
            'desc:html',
        ],
    ]) ?>

</div>
