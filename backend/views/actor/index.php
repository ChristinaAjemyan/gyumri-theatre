<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Sort;

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
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($data){
                    return Html::img(Yii::getAlias('@web').'/uploads/'.$data['img_path'], ['height' => '50px']);
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
