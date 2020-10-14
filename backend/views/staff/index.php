<?php

use common\models\Main;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\Sort;
use slavkovrn\lightbox\LightBoxWidget;
use common\models\Role;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Staff', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'src' => Yii::getAlias('@web').'/upload/avatars/staff/400/'.$data['img_path'], ['height' => '50px'],
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
            [
                'header' => 'first_name',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->first_name);
                },
            ],
            [
                'header' => 'last_name',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->last_name);
                },
            ],
//            'date_of_birth',
            [
                'header' => 'Role',
                'content' => function ($data){
                    return Role::find()->where(['id' => $data['role_id']])->asArray()->one()['name'];
                },
            ],
            [
                'header' => 'Age',
                'content' => function ($data){
                    return floor((time() - strtotime($data['date_of_birth'])) / 31556926);
                },
            ],

            //'img_path',
            [
                'header' => 'country',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->country);
                },
            ],
            [
                'header' => 'city',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->city);
                },
            ],
            //'slug,'
            //'inst_url',
            //'staff_genre_type',
            //'desc:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
