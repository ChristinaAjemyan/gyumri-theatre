<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Sort;
use slavkovrn\lightbox\LightBoxWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Actor', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'src' => Yii::getAlias('@web').'/upload/avatars/'.$data['img_path'], ['height' => '50px'],
                            'title' => $data['first_name'].' '.$data['last_name'],
                        ]
                    ];
                    return LightBoxWidget::widget([
                        'id'     =>'lightbox',
                        'class'  =>'galary',
                        'height' =>'50px',
                        'images' => $images,
                    ]);
                }
            ],
            //'id',
            'first_name',
            'last_name',
            'birthday',
            //'img_path',
            'country',
            'city',
            //'desc:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
