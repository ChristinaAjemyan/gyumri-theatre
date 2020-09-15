<?php

namespace backend\controllers;

use app\models\Translate;
use Yii;
use app\models\Role;
use app\models\RoleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'translate'],
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
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
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();
        $model_translate = new Translate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model_translate->load(Yii::$app->request->post()) && $model_translate->save()) {
            $model_translate->table_name = $model->tableName();
            $model_translate->column_name = array_keys($model->attributes)[1];
            $model_translate->language = Yii::$app->request->get('lang');
            $model_translate->save();
            return $this->redirect(['/translate/view', 'id' => $model_translate->id]);
        }

        return $this->render('create', [
            'model' => $model, 'model_translate' => $model_translate
        ]);
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_translate = $this->findModelTranslate($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'model_translate' => $model_translate
        ]);
    }

    public function actionTranslate($id = null)
    {
        //$model_translate = $this->findModelTranslate($id);
        //var_dump($id);

        $translate = new Translate();
        $model_translate = $this->findModelTranslate($id);
        if ($translate->load(Yii::$app->request->post()) && $translate->save()) {
            $translate->table_name = 'role';
            $translate->column_name = 'name';
            $translate->language = Yii::$app->request->get('lang');
            $translate->table_id = $id;
            $translate->save();

            return $this->redirect(['/translate/view', 'id' => $translate->id]);
        }

        return $this->render('translate', [
            'model_translate' => $model_translate
        ]);
    }

    /**
     * Deletes an existing Role model.
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
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelTranslate($id)
    {
        if (($model = Translate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
