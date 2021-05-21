<?php

namespace frontend\controllers;

use common\models\Archive;
use common\models\ArchiveImage;
use common\models\ArchivePerformance;
use common\models\Performance;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class ArchiveController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = Yii::t('home', 'Արխիվ');
        $theatre_seasons = Archive::find()->all();
        $active_season = Archive::find()->where(['active_season' => 1])->one();

        $season_performances = [];
        $archive_performances = ArchivePerformance::find()->where(['archive_id' => $active_season->id])->all();
        foreach ($archive_performances as $archive_performance){
            $season_performances[] = Performance::find()->where(['id' => $archive_performance->performance_id])->all();
        }

        if (Yii::$app->request->isAjax){

            $performances_by_season = [];
            $performances = [];
            $season_arr = [];
            if (Yii::$app->request->post('id')){
                $id = Yii::$app->request->post('id');
                $season = Archive::find()->where(['id' => $id])->one();
                $arch_performances = ArchivePerformance::find()->where(['archive_id' => $season->id])->orderBy(['ordering'=>SORT_ASC])->all();
                $images = ArchiveImage::find()->where(['archive_id' => $season->id])->all();

                $season_arr['title'] = Yii::t('text', $season->title);
                $season_arr['content'] = Yii::t('text', $season->content);
                foreach ($images as $i => $item){
                    $season_arr['images'][] = $item->image;
                }
                foreach ($arch_performances as $key => $value){
                    $performances_by_season[] = Performance::find()->where(['id' => $value->performance_id])->asArray()->all();
                }
                foreach ($performances_by_season as $i => $item){
                    foreach ($item as $value){
                        $performances[$i]['title'] = Yii::t('text', $value['title']);
                        $performances[$i]['show_date'] = Performance::getPerformanceTime($value['show_date']);
                        $performances[$i]['img_path'] = $value['img_path'];
                        $performances[$i]['slug'] = Yii::t('text', $value['slug']);
                    }
                }
            }

            return Json::encode([
                'performances' => $performances,
                'backend_url' => Yii::$app->params['backend-url'],
                'season' => $season_arr,
                'lang' => Yii::$app->request->cookies->getValue('language')
            ]);
        }


        return $this->render('index', [
            'theatre_seasons' => $theatre_seasons,
            'active_season' => $active_season,
            'season_performances' => $season_performances
        ]);
    }

    public function actionActiveSeason(){
        if (Yii::$app->request->isAjax){
            $active_season = Archive::find()->where(['active_season' => 1])->one();
            $images = ArchiveImage::find()->where(['archive_id' => $active_season->id])->all();
            $season_arr = [];
            foreach ($images as $i => $item){
                $season_arr['images'][] = $item->image;
            }
            return Json::encode([
                'performances' => ArchivePerformance::find()->where(['archive_id' => $active_season->id])->all(),
                'images_length' => count($season_arr['images'])
            ]);
        }
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