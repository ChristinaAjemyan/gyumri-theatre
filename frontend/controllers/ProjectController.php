<?php

namespace frontend\controllers;

use common\models\Project;
use common\models\ProjectImages;
use common\models\ProjectVideos;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;


class ProjectController extends Controller
{
    public function actionIndex(){
        $this->view->title = Yii::t('home', 'ՆԱԽԱԳԾԵՐ');

        $projectsData = Project::find()->orderBy(['id'=>SORT_DESC])->asArray();

        $pages = new Pagination([
            'totalCount' => $projectsData->count(),
            'defaultPageSize' => 10,
        ]);

        $project = $projectsData->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',[
            'projects'=>$project,
            'pages'=>$pages,
        ]);
    }

    public function actionView($id){
        $projectsData=Project::find()->where(['id'=>$id])->one();
        $this->view->title = Yii::t('home', $projectsData->title);
        $multiple_img=ProjectImages::find()->where(['project_id'=>$id])->all();
        $multiple_video=ProjectVideos::find()->where(['project_id'=>$id])->asArray()->all();
        return $this->render('view',[
            'project'=>$projectsData,
            'images'=>$multiple_img,
            'videos'=>$multiple_video,
        ]);
    }
}