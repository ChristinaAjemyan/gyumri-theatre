<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 18.09.2020
 * Time: 19:45
 */

namespace frontend\controllers;


use common\models\GenrePerformance;
use common\models\Image;
use common\models\Main;
use common\models\Message;
use common\models\Performance;
use common\models\SourceMessage;
use common\models\TypePerformance;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PerformanceController extends Controller
{
    public function actionIndex(){
        $this->view->title = Yii::t('home', 'Ներկայացումներ');

        $performancesAll = Performance::find()->orderBy(['ordering'=>SORT_ASC])->asArray();

        $pages = new Pagination([
            'totalCount' => $performancesAll->count(),
            'defaultPageSize' => 15,
        ]);
        $performances = $performancesAll->offset($pages->offset)
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

        if (Yii::$app->request->isAjax){
            $type_id = Yii::$app->request->post('id');
            $performances_arr = [];

            if ($type_id != 0) {
                $performances = TypePerformance::find()->with('performance')->where(['type_id' => $type_id])->orderBy(['id' => SORT_DESC])->asArray()->all();
            } else {
                $performances = Performance::find()->orderBy([new \yii\db\Expression('show_date IS not NULL DESC, show_date ASC')])->asArray()->all();

            }

            $val = null;
            foreach ($performances as $i => $item){
                if ($type_id == 0){
                    $val = $item;
                }else{
                    $val = $item['performance'];
                }
                $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $val['id']])->asArray()->all();
                $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name');
                $str = '';
                foreach ($genre as $value){
                    $str .= ' '.Yii::t('text', $value).',';
                }
                $performances_arr[$val['ordering']]['id'] = $val['id'];
                $performances_arr[$val['ordering']]['author'] = Yii::t('text', $val['author']);
                $performances_arr[$val['ordering']]['title'] = Yii::t('text', $val['title']);
                $performances_arr[$val['ordering']]['slug'] = Yii::t('text', $val['slug']);
                $performances_arr[$val['ordering']]['desc'] = Yii::t('text', $val['desc']);
                $performances_arr[$val['ordering']]['short_desc'] = Yii::t('text', $val['short_desc']);
                $performances_arr[$val['ordering']]['show_date'] = $val['show_date'];
                $performances_arr[$val['ordering']]['hall'] = $val['hall'];
                $performances_arr[$val['ordering']]['tour_link'] = $val['tour_link'];
                $performances_arr[$val['ordering']]['img_path'] = Yii::t('text', $val['img_path']);
                $performances_arr[$val['ordering']]['genre'] = trim($str, ',');
                $performances_arr[$val['ordering']]['age_restriction'] = $val['age_restriction'];
                $performances_arr[$val['ordering']]['performance_length'] = $val['performance_length'];
                $performances_arr[$val['ordering']]['date'] = Performance::getPerformanceTime($val['show_date']);
                $performances_arr[$val['ordering']]['external_id'] = $val['external_id'];
            }
            asort($performances_arr);
            return Json::encode([
                'performances' => $performances_arr,
                'base_path' => Yii::$app->params['backend-url'],
                'lang' => Yii::$app->request->cookies->getValue('language')
            ]);
        }
        return $this->render('index', compact('performances', 'pages'));
    }

    public function actionBig(){
        $this->view->title = Yii::t('home', 'Ներկայացումներ');
        $performancesBigHall = Performance::find()->where(['hall' => 0])
            ->orderBy(['ordering' => SORT_ASC])->asArray();
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

        return $this->render('big', compact('performances', 'pages'));
    }

    public function actionSmall(){
        $this->view->title = Yii::t('home', 'Ներկայացումներ').' - '.Yii::t('home', 'Փոքր թատրոն');
        $performancesSmallHall = Performance::find()->where(['hall' => 1])->orderBy(['ordering' => SORT_ASC])->asArray();
        $pages = new Pagination([
            'totalCount' => $performancesSmallHall->count(),
            'defaultPageSize' => 15,
        ]);
        $performances = $performancesSmallHall->offset($pages->offset)
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
    public function actionView($slug)
    {
        $cookieLanguage = Yii::$app->request->cookies->getValue('language');
        if ($cookieLanguage == 'ru' || $cookieLanguage == 'en'){
            $message_id = Message::find()->where(['translation' => $slug])->one()->id;
            $source_message = SourceMessage::find()->where(['id' => $message_id])->one()->message;
            $model = Performance::find()->where(['slug' => $source_message])->one();
        }else{
            $model = Performance::find()->where(['slug' => $slug])->one();
        }
        $this->view->title = Main::uppercaseFirstLetter($model->title);
        empty($model) ? $this->goHome() : false;


        return $this->render('view', ['model' => $model]);
    }

    public function actionModalOrdering()
    {
        if (Yii::$app->request->isAjax && isset($_GET['id'])){

            return $this->renderAjax('modal_ordering',['id' => $_GET['id']]);
        }
    }

    public function actionMultipleVideos(){
        if (Yii::$app->request->isAjax && isset($_GET['id'])){
            $model = $this->findModel($_GET['id']);

            return $this->renderAjax('multiple-videos',['id' => $_GET['id'],'model' => $model]);
        }
    }

    public function actionMultipleGalleries(){
        if (Yii::$app->request->isAjax && isset($_GET['id'])){

            return $this->renderAjax('multiple-galleries',['id' => $_GET['id']]);
        }
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
