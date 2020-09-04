<?php

namespace backend\controllers;

use backend\models\CompanySettings;
use Faker\Provider\ar_JO\Company;
use Yii;
use backend\models\Companies;
use backend\models\CompaniesSearch;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
                    'delete' => ['POST'],
//                    'change-type' => ['POST'],
                ],
            ],
//            'authenticator' => [
//                'except' => ['change-type'],
//                'class' => HttpBearerAuth::className(),
//            ],


        ];
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * Lists all Companies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Companies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionCompanyUpdate()
    {
        $objUser = Yii::$app->user->identity;
        $model = $this->findModel($objUser->company_id);
        $companySettings = CompanySettings::find()->where(['company_id'=>$objUser->company_id])->one();
        if(!$companySettings){
            $companySettings = new CompanySettings();
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $model->upload();
                $model->logo  = '/upload_avatars/company_logos/'.$model->imageFile->name;
            }
            $companySettings->save();
            $model->save();

        }
        return $this->render('update', [
            'model' => $model,
            'companySettings'=>$companySettings

        ]);
    }

    public function actionUpdateCompany(){
        var_dump(Yii::$app->request->post());die;

    }
    public function actionGetCompany(){
        $objUser = Yii::$app->user->identity;
        $arrResult['company'] = Companies::find()->where(['id'=>$objUser->company_id])->asArray()->one();
        $arrResult['companySettings'] = CompanySettings::find()->where(['company_id'=>$objUser->company_id])->asArray()->one();
        return json_encode($arrResult);
    }
    public function actionChangeType()
    {
        $objUser = Yii::$app->user->identity;
        $type = Yii::$app->request->post('type');


        $model = $this->findModel($objUser->company_id);
        $model->type = $type;
        if($model->save()){
            return Json::encode(['success'=>true]);
        }

    }
    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
