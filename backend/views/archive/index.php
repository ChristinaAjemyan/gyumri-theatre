<?php

use common\models\Main;
use slavkovrn\lightbox\LightBoxWidget;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArchiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Archives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archive-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Archive', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Ordering Page', ['ordering'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'title',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->title);
                },
            ],
            //'content:ntext',
            //'img_path',
            [
                'header' => 'active season',
                'content' => function ($data){
                     return $data->active_season == 1 ? 'YES' : 'NO';
                }
            ],
            'dt_create',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>