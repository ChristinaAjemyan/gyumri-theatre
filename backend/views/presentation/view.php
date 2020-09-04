<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Actor;
use app\models\ActorPresentation;

/* @var $this yii\web\View */
/* @var $model app\models\Presentation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Presentations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="presentation-view">

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
                'value' =>('<img src =' .'/upload_avatars/' . $model->img_path . ' width="300"' .   '>')
            ],
            //'id',
            'title',
            //'img_path',
            [
                'attribute' => 'actors',
                'format' => 'html',
                'value' => function($model){
                    $result = ""; $arr = [];
                    $actors = ActorPresentation::find()->where(['presentation_id' => $model->id])->asArray()->all();
                    foreach ($actors as $item){
                        $first_name = Actor::find()->where(['id' => $item['actor_id']])->asArray()->all()[0]['first_name'];
                        $last_name = Actor::find()->where(['id' => $item['actor_id']])->asArray()->all()[0]['last_name'];
                        $arr[$item['actor_id']] = $first_name.' '.$last_name;
                    }
                    foreach ($arr as $key => $value){
                        $result .= Html::a($value, "/actor/view?id=$key", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold'])." ";
                    }
                    return $result;
                }
            ],
            'show_date',
            'trailer',
            'desc:ntext',
            'is_new'
        ],

    ]) ?>

</div>
