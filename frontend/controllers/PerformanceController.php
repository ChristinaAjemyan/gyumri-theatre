<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 18.09.2020
 * Time: 19:45
 */

namespace frontend\controllers;


use common\models\GenrePerformance;
use common\models\Performance;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PerformanceController extends Controller
{
    public function actionIndex(){
        $this->view->title = Yii::t('home', 'ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ');
        $performancesBigHall = Performance::find()->where(['hall' => 0])->orderBy(['id' => SORT_DESC])->asArray();
        $pages = new Pagination([
            'totalCount' => $performancesBigHall->count(),
            'defaultPageSize' => 15,
        ]);
        $performances = $performancesBigHall->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if (!empty($performances) && isset($performances)){
            foreach ($performances as $key => $value){
                $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $value['id']])->asArray()->all();
                $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name');
                $str = '';
                foreach ($genre as $item){
                    $str .= ' '.Yii::t('text', $item).',';
                }
                $performances[$key]['genre'] = trim($str, ',');
                $performances[$key]['func_date'] = Performance::getPerformanceTime($value['show_date']);
            }
        }

        return $this->render('index', compact('performances', 'pages'));
    }

    public function actionSmall(){
        $this->view->title = Yii::t('home', 'ՆԵՐԿԱՅԱՑՈՒՄՆԵՐ').' - '.Yii::t('home', 'ՓՈՔՐ ԹԱՏՐՈՆ');
        $performancesBigHall = Performance::find()->where(['hall' => 1])->orderBy(['id' => SORT_DESC])->asArray();
        $pages = new Pagination([
            'totalCount' => $performancesBigHall->count(),
            'defaultPageSize' => 15,
        ]);
        $performances = $performancesBigHall->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if (!empty($performances) && isset($performances)){
            foreach ($performances as $key => $value){
                $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $value['id']])->asArray()->all();
                $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name');
                $str = '';
                foreach ($genre as $item){
                    $str .= ' '.Yii::t('text', $item).',';
                }
                $performances[$key]['genre'] = trim($str, ',');
                $performances[$key]['func_date'] = Performance::getPerformanceTime($value['show_date']);
            }
        }

        return $this->render('small', compact('performances', 'pages'));
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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
     * @return Performance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Performance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
