<?php

namespace backend\controllers;

use Yii;
use app\models\Actor;
use app\models\ActorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * ActorController implements the CRUD actions for Actor model.
 */
class ActorController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all Actor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Actor model.
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
     * Creates a new Actor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Actor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (!is_dir('upload/avatars/')){
                mkdir('upload/avatars/',0777, true);
            }
            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/' . $img_name);
            }else{
                copy('image/default.jpg', 'upload/avatars/default.jpg');
                $model->img_path = 'default.jpg';
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Actor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()['img_path']);
                                                                
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                if (file_exists('upload/avatars/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                    $_SESSION['img_name'] !== 'default.jpg'){
                    unlink('upload/avatars/'.$_SESSION['img_name']);
                }
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/' . $img_name);
            }else{
                if (file_exists('upload/avatars/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                    $_SESSION['img_name'] !== 'default.jpg'){
                    unlink('upload/avatars/'.$_SESSION['img_name']);
                }
                copy('image/default.jpg', 'upload/avatars/default.jpg');
                $model->img_path = 'default.jpg';
                $model->save();
            }
            unset($_SESSION['img_name']);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Actor model.
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
     * Finds the Actor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Actor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Actor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
