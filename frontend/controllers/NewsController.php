<?php

namespace frontend\controllers;

use common\models\Staff;
use Yii;
use yii\web\Controller;
use common\models\News;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = Yii::t('home', 'Նորություններ');
        $news = News::find()->where(['show_type'=>1]);
        $articles=News::find()->where(['show_type'=>2]);

        $pages = new Pagination([
            'totalCount' => $news->count(),
            'defaultPageSize' => 12,
            'params' => array_merge($_GET, ['show' => 'videos'])
        ]);
        $pagesTwo= new Pagination([
            'totalCount' =>$articles->count(),
            'defaultPageSize'=> 4,
            'params' => array_merge($_GET, ['show' => 'articles'])
        ]);
        $contents = $news->orderBy(['ordering' => SORT_ASC])->asArray()->offset($pages->offset)->limit($pages->limit)->all();
        $contentsTwo= $articles->orderBy(['ordering' => SORT_ASC])->asArray()->offset($pagesTwo->offset)->limit($pagesTwo->limit)->all();

        return $this->render('index', [
            'pages' => $pages,
            'contents' => $contents,
            'pagesTwo'=>$pagesTwo,
            'contentsTwo'=>$contentsTwo,
        ]);
    }


    public function actionView($id)
    {
        $this->view->title = Yii::t('text', $this->findModel($id)->title);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}