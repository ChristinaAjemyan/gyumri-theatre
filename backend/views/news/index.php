<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data){
                    return Html::img(Yii::getAlias('@web').'/uploads/'.$data['img_path'], ['height' => '50px']);
                }
            ],
            //'id',
            'title',
            'content:ntext',
            //'img_path',
            'dt_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
