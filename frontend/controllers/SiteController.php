<?php
namespace frontend\controllers;

use common\models\Archive;
use common\models\GenrePerformance;
use common\models\Message;
use common\models\News;
use common\models\Performance;
use common\models\SourceMessage;
use common\models\Staff;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Cookie;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = Yii::t('home', 'Գյումրու Դրամատիկական թատրոն');
        $performances = Performance::find()->orderBy([new \yii\db\Expression('show_date IS not NULL DESC, show_date ASC')])->limit(6)->all();
        $performanceSoon = Performance::find()->where(['is_new' => 1])->orderBy(['id' => SORT_DESC])->one();

        if (Yii::$app->request->post('day') || Yii::$app->request->post('monthDays')){
            if (Yii::$app->request->post('day')){
                $day = Yii::$app->request->post('day');
                $start = date('Y-m-d 00:00:00', strtotime("$day this week"));
                $end = date('Y-m-d 23:59:59', strtotime("$day this week"));
            }else{
                $nowDay = date('Y-m-d');
                $start = date('Y-m-01 00:00:00', strtotime($nowDay));
                $end = date('Y-m-t 23:59:59', strtotime($nowDay));
            }
            $performanceByDays = Performance::find()->where(['between', 'show_date', $start, $end])
                ->orderBy([new \yii\db\Expression('show_date IS not NULL DESC, show_date ASC')])->asArray()->all();
            $arr = []; $arrLastData = [];
            foreach ($performanceByDays as $key => $value){
                if ($value['show_date'] < date('Y-m-d H:i:s')){
                    unset($performanceByDays[$key]);
                    $arr[] = $value;
                    $arrLastData = array_reverse($arr);
                }
            }
            foreach ($arrLastData as $item){
                $performanceByDays[] = $item;
            }
            foreach ($performanceByDays as $key => $value){
                $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $value['id']])->asArray()->all();
                $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name');
                $str = '';
                foreach ($genre as $item){
                    $str .= ' '.Yii::t('text', $item).',';
                }
                $performanceByDays[$key]['genre'] = trim($str, ',');
                $performanceByDays[$key]['func_date'] = Performance::getPerformanceTime($value['show_date']);
            }
            foreach ($performanceByDays as $key => $val){
                $performanceByDays[$key]['title'] = Yii::t('text', $val['title']);
                $performanceByDays[$key]['author'] = Yii::t('text', $val['author']);
                $performanceByDays[$key]['short_desc'] = Yii::t('text', $val['short_desc']);
                $performanceByDays[$key]['desc'] = Yii::t('text', $val['desc']);
                $performanceByDays[$key]['tour_link'] = $val['tour_link'];
                $performanceByDays[$key]['slug'] = Yii::t('text', $val['slug']);
                $performanceByDays[$key]['external_id'] = $val['external_id'];
            }
            if (empty($performanceByDays)){
                return Json::encode(['error' => true, 'lang' => Yii::$app->request->cookies->getValue('language')]);die;
            }
            return Json::encode(['success' => $performanceByDays,
                'basePath' => Yii::$app->params['backend-url'], 'error' => false,
                'lang' => Yii::$app->request->cookies->getValue('language')]);die;
        }
        return $this->render('index', compact('performances',
            'performanceSoon'));
    }

    public function actionChronicle()
    {
        $this->view->title = Yii::t('home', 'Տարեգրություն');

        return $this->render('chronicle');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->view->title = Yii::t('home', 'Մեր մասին');

        return $this->render('about');
    }

    public function actionSearch()
    {
        $this->view->title = Yii::t('home', 'Որոնման արդյունք');
        $searchInformation = [];
        if (Yii::$app->request->get()) {
            $inputVal = Yii::$app->request->get('search');
            if (!$inputVal){
                return $this->redirect('/site/search');
            }
            if (!strpos(trim($inputVal, ' '), ' ') && is_numeric(trim($inputVal, ' '))
                && strlen(trim($inputVal, ' ')) < 3){
                $inputVal = false;
            }
            $inputVal ? $searchName = explode(' ', trim($inputVal, ' ')) : $searchName = [];
            $str = ''; $num = []; $searchNameData = []; $count = 0;
            if (count($searchName) > 1){
                foreach ($searchName as $key => $value){
                    $str .= $value;
                }
                foreach ($searchName as $k => $v){
                    if (is_numeric($v) && strlen($v) >= 3){
                        $num[] = $searchName[$k];
                        $count = 1;
                    }else if (is_numeric($v) && strlen($v) < 3){
                        $count = 1;
                        unset($searchName[$k]);
                    }
                }
                foreach ($searchName as $k => $v){
                    if (!is_numeric($v) && $count == 0){
                        $num[] = $v;
                    }
                }
                unset($searchName);
                foreach ($num as $val){
                    $searchName[] = $val;
                }

                $searchName[] = $str;
                array_push($searchName, trim($inputVal, ' '));
            }
            if (preg_match('/[А-Яа-яЁё]/u', trim($inputVal, ' ')) || preg_match('/[A-Za-z]/', trim($inputVal, ' '))){
                foreach ($searchName as $key => $item){
                    $searchNameData[] = Message::find()->where(['like', 'translation', '%' . $item . '%', false])->asArray()->all();
                }
                if (!empty($searchNameData) && isset($searchNameData)){
                    unset($searchName);
                    foreach ($searchNameData as $value){
                        foreach ($value as $key => $val){
                            $searchName[] = SourceMessage::find()->where(['id' => $val['id']])->asArray()->all()[0]['message'];
                        }
                    }
                }
            }
            $wherePerformance = ''; $whereStaff = ''; $whereNews = '';
            if (!empty($searchName) && isset($searchName)){
                foreach ($searchName as $item){
                    $wherePerformance .= " `title` LIKE '%{$item}%' or `short_desc` LIKE '%{$item}%' or
                `desc` LIKE '%{$item}%' or";
                    $whereStaff .= " `first_name` LIKE '%{$item}%' or `last_name` LIKE '%{$item}%' or
                `country` LIKE '%{$item}%' or `city` LIKE '%{$item}%' or `desc` LIKE '%{$item}%' or";
                    $whereNews .= " `title` LIKE '%{$item}%' or `content` LIKE '%{$item}%' or";
                }
                $searchInformation['performance'] = Performance::find()->where(rtrim($wherePerformance, 'or'))->asArray()->all();
                $searchInformation['staff'] = Staff::find()->where(['role_id' => 1])->andwhere(rtrim($whereStaff, 'or'))->asArray()->all();
                $searchInformation['news'] = News::find()->where(rtrim($whereNews, 'or'))->asArray()->all();

                if (!empty($searchInformation['performance']) && isset($searchInformation['performance'])){
                    foreach ($searchInformation['performance'] as $key => $value){
                        $genres = GenrePerformance::find()->with('genre')->where(['performance_id' => $value['id']])->asArray()->all();
                        $genre = ArrayHelper::map(ArrayHelper::map($genres, 'id', 'genre'), 'id', 'name');
                        $str = '';
                        foreach ($genre as $item){
                            $str .= ' '.Yii::t('text', $item).',';
                        }
                        $searchInformation['performance'][$key]['genre'] = trim($str, ',');
                        $searchInformation['performance'][$key]['func_date'] = Performance::getPerformanceTime($value['show_date']);
                    }
                }
            }
        }
        return $this->render('search', ['searchInformation' => $searchInformation]);
    }


    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $performances = Performance::find()->orderBy([new \yii\db\Expression('show_date IS not NULL DESC, show_date ASC')])->limit(6)->all();
        $this->view->title = Yii::t('home', 'Կապ');
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Շնորհակալություն մեզ հետ կապվելու համար: Մենք ձեզ կպատասխանենք հնարավորինս շուտ:');
            } else {
                Yii::$app->session->setFlash('error', 'Ձեր հաղորդագրությունն ուղարկելիս սխալ տեղի ունեցավ:');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'performances' => $performances
            ]);
        }
    }


    public function actionLanguage(){
        $language = Yii::$app->request->post('language');
        Yii::$app->language = $language;
        $languageCookie = new Cookie([
            'name' => 'language',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30
        ]);
        Yii::$app->response->cookies->add($languageCookie);
        return $this->goHome();
    }

}
