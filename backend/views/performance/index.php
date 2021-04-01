<?php

use common\models\Main;
use pcrt\widgets\datepicker\Datepicker;
use yii\helpers\Html;
use yii\grid\GridView;
use slavkovrn\lightbox\LightBoxWidget;
use common\models\Staff;
use common\models\StaffPerformance;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PerformanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Performances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="performance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Performance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => 'image',
                'contentOptions' => ['class' => 'text-center st_images'],
                'content' => function ($data){
                    $images = [
                        [
                            'src' => Yii::getAlias('@web').'/upload/avatars/performance/original/'.$data['img_path'], ['height' => '50px'],
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
            [
                'header' => 'title',
                'content' => function ($data){
                    return Main::uppercaseFirstLetter($data->title);
                },
            ],
            //'img_path',
            [
                'header' => 'staff',
                'format' => 'raw',
                'value' => function($data){
                    $result = ""; $arr = []; $num = 0;
                    $staff = StaffPerformance::find()->where(['performance_id' => $data->id])->asArray()->all();

                    $str = '';
                    if (count($staff) > 3){
                        $str .= Html::a('<i class="fas fa-ellipsis-h"></i>', "", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold',
                            'data-toggle' => 'modal', 'data-target' => '#modalLong'.$data->id]);
                    }
                    foreach ($staff as $item){
                        $first_name = Staff::find()->where(['id' => $item['staff_id']])->asArray()->all()[0]['first_name'];
                        $last_name = Staff::find()->where(['id' => $item['staff_id']])->asArray()->all()[0]['last_name'];
                        $arr[$item['staff_id']] = Main::uppercaseNames($first_name).' '.Main::uppercaseNames($last_name);
                    }
                    foreach ($arr as $key => $value){?>
                        <div class="modal fade" id="modalLong<?= $data->id; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="ModalLongTitle">Staff</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php foreach ($arr as $k => $v): ?>
                                        <?= Html::a($v, "/staff/view?id=$k", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold'])." "; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $num += 1;
                        if ($num >= 4){
                            break;
                        }
                        $result .= Html::a($value, "/staff/view?id=$key", ['class' => 'btn btn-info mb-1 px-2 py-0 font-weight-bold'])." ";
                    }
                    return $result.$str;
                },
            ],
            //'banner',
            'show_date',

            //'slug',
            //'trailer',
            //'age_restriction',
            //'performance_length',
            //'author',
            [
                'header' => 'hall',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->hall == 0 ? 'Մեծ բեմ' : ($model->hall == 1 ? 'Փոքր թատրոն' : 'Հյուրախաղ');
                }
            ],
            //'short_desc:html',
            //'desc:html',
            [
                'header' => 'is_new',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->is_new == 0 ? '' : 'Շուտով';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

?>


</div>