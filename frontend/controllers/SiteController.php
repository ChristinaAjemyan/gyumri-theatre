<?php
namespace frontend\controllers;

use common\models\GenrePerformance;
use common\models\Performance;
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
/*    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
/*    public function actions()
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
    }*/

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->title = 'Գյումրու պետական դրամատիկական թատրոն';
        $performances = Performance::find()->orderBy(['id' => SORT_DESC])->limit(6)->all();
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
                ->orderBy(['show_date' => SORT_ASC])->asArray()->all();
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
            }
            if (empty($performanceByDays)){
                echo Json::encode(['error' => true, 'lang' => Yii::$app->request->cookies->getValue('language')]);die;
            }
            echo Json::encode(['success' => $performanceByDays,
                'basePath' => Yii::$app->params['backend-url'], 'error' => false,
                'lang' => Yii::$app->request->cookies->getValue('language')]);die;
        }
        return $this->render('index', compact('performances',
            'performanceSoon'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $this->view->title = 'Մեր մասին';

        return $this->render('about');
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
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
