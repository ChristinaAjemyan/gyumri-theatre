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

        return $this->render('index', compact('performances', 'pages'));
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

        return $this->render('view', [
            'model' => $model,
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
