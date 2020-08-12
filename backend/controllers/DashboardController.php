<?php

namespace backend\controllers;

use backend\models\Companies;
use backend\models\CompanySettings;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class DashboardController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$this->layout = 'old';
        $objUser = Yii::$app->user->identity;
        $objCompany = new Companies();
        $objSety = new CompanySettings();

        if($objUser->hasAccess('new')){
           return $this->render('verification_steps', [
               'model' => $objCompany,
               'settings' => $objSety,
           ]);
        }else{
            return $this->render('index', [
                'model' => $objCompany,
                'settings' => $objSety,
            ]);
        }

    }

}
