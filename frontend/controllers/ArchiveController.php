<?php

namespace frontend\controllers;

use common\models\Archive;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ArchiveController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = Yii::t('home', 'Արխիվ');
        $archive = Archive::find();

        $pages = new Pagination([
            'totalCount' => $archive->count(),
            'defaultPageSize' => 15,
        ]);
        $contents = $archive->orderBy(['id' => SORT_DESC])->asArray()->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'pages' => $pages,
            'contents' => $contents
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
     * @return Archive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Archive::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}