<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 18.09.2020
 * Time: 19:45
 */

namespace frontend\controllers;


use common\models\Performance;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PerformanceController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function actionIndex()
    {
        $this->view->title = 'Գյումրու պետական դրամատիկական թատրոն';

        return $this->render('index');
    }

    public function actionView()
    {
        $this->view->title = 'Թատրոն';
        $performance = new Performance();


        return $this->render('view');
    }
}
