<?php

use common\models\Main;
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
        'filterModel' => null,
        'tableOptions' => [
            'id' => 'sortableNews',
            'class'=>'table table-bordered sortableTables',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'image',
                'contentOptions' => ['class' => 'text-center st_images'],
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
                        'height' => '50px',
                        'images' => $images,
                    ]);
                }
            ],
            //'id',
            [
                'header' => 'title',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->title);
                },
            ],
            //'content:ntext',
            //'img_path',
            'dt_create',
            [
                'header' => 'ordering',
                'value' => function ($model) {
                    return $model->ordering;
                }
            ],
            [
                'header' => 'show type',
                'value' => function ($model) {
                    if ($model->show_type==1){
                        return 'video';
                    }
                    if ($model->show_type==2){
                        return 'articles';
                    }
                    return 'not select';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>