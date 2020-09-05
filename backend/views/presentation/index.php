<?php

use yii\helpers\Html;
use yii\grid\GridView;
use slavkovrn\lightbox\LightBoxWidget;
use app\models\Actor;
use app\models\ActorPresentation;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PresentationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Presentations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presentation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Presentation', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'title' => $data['title'],
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
            'title',
            //'img_path',
            [
                'header' => 'actors',
                'format' => 'raw',
                'value' => function($data){
                    $result = ""; $arr = []; $num = 0;
                    $actors = ActorPresentation::find()->where(['presentation_id' => $data->id])->asArray()->all();

                    $str = '';
                    if (count($actors) >= 3){
                        $str .= Html::a('<i class="fas fa-ellipsis-h"></i>', "", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold',
                            'data-toggle' => 'modal', 'data-target' => '#modalLong'.$data->id]);
                    }
                    foreach ($actors as $item){
                        $first_name = Actor::find()->where(['id' => $item['actor_id']])->asArray()->all()[0]['first_name'];
                        $last_name = Actor::find()->where(['id' => $item['actor_id']])->asArray()->all()[0]['last_name'];
                        $arr[$item['actor_id']] = $first_name.' '.$last_name;
                    }
                    foreach ($arr as $key => $value){?>
                        <div class="modal fade" id="modalLong<?= $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="ModalLongTitle">Actors</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php foreach ($arr as $k => $v): ?>
                                        <?= Html::a($v, "/actor/view?id=$k", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold'])." "; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $num += 1;
                        if ($num >= 4){
                            break;
                        }
                        $result .= Html::a($value, "/actor/view?id=$key", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold'])." ";
                    }
                    return $result.$str;
                },
            ],
            'show_date',
            //'trailer',
            'desc:ntext',
            'is_new',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

?>


</div>





