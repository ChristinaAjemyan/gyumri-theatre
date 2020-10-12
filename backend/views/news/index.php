<?php

use yii\helpers\Html;
use yii\grid\GridView;
use slavkovrn\lightbox\LightBoxWidget;

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
                'header' => 'image',
                'contentOptions' => ['class' => 'text-center'],
                'content' => function ($data){
                    $images = [
                        [
                            'src' => Yii::getAlias('@web').'/upload/avatars/news/200/'.$data['img_path'],
                            'title' => $data['title'],
                        ]
                    ];
                    return LightBoxWidget::widget([
                        'id'     => 'lightbox',
                        'class'  => 'galary',
                        'height' => '70px',
                        'images' => $images,
                    ]);
                }
            ],
            //'id',
            'title',
            //'content:ntext',
            //'img_path',
            'dt_create',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
