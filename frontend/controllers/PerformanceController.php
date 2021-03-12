<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 18.09.2020
 * Time: 19:45
 */

namespace frontend\controllers;


use common\models\GenrePerformance;
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

        $performancesEvening = Performance::find()->orderBy(['id' => SORT_DESC])->asArray();


//        $performancesEvening = TypePerformance::find()->with('performance')->where(['type_id' => 2])->orderBy(['id' => SORT_DESC])->asArray();
//        $performancesEven = Performance::find()->orderBy(['id' => SORT_DESC])->asArray()->all();
//        echo '<pre>';
//        var_dump($performance_type);
/*        foreach ($performance_type as $item){

            $performancesEvening = $item['performance'];
        }
        die();*/
        $pages = new Pagination([
            'totalCount' => $performancesEvening->count(),
            'defaultPageSize' => 15,
        ]);
        $performances = $performancesEvening->offset($pages->offset)
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
                $performances = Performance::find()->orderBy(['id' => SORT_DESC])->asArray()->all();

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
                $performances_arr[$i]['id'] = $val['id'];
                $performances_arr[$i]['author'] = Yii::t('text', $val['author']);
                $performances_arr[$i]['title'] = Yii::t('text', $val['title']);
                $performances_arr[$i]['slug'] = Yii::t('text', $val['slug']);
                $performances_arr[$i]['desc'] = Yii::t('text', $val['desc']);
                $performances_arr[$i]['short_desc'] = Yii::t('text', $val['short_desc']);
                $performances_arr[$i]['show_date'] = $val['show_date'];
                $performances_arr[$i]['img_path'] = Yii::t('text', $val['img_path']);
                $performances_arr[$i]['genre'] = trim($str, ',');
                $performances_arr[$i]['age_restriction'] = $val['age_restriction'];
                $performances_arr[$i]['performance_length'] = $val['performance_length'];
                $performances_arr[$i]['date'] = Performance::getPerformanceTime($val['show_date']);
            }
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

        return $this->render('big', compact('performances', 'pages'));
    }

    public function actionSmall(){
        $this->view->title = Yii::t('home', 'Ներկայացումներ').' - '.Yii::t('home', 'Փոքր թատրոն');
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
