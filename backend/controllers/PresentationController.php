<?php

namespace backend\controllers;

use app\models\ActorPresentation;
use app\models\Image;
use Yii;
use app\models\Presentation;
use app\models\PresentationSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * PresentationController implements the CRUD actions for Presentation model.
 */
class PresentationController extends Controller
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
     * Lists all Presentation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresentationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presentation model.
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
     * Creates a new Presentation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Presentation();
        $model_act_present = new ActorPresentation();
        $model_image = new Image();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (!is_dir('upload/avatars/')){
                mkdir('upload/avatars/',0777, true);
            }
            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $model->img_path = time() . '.' . $model->avatar_image->extension;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/' . time() . '.' . $model->avatar_image->extension);
            }else{
                copy('image/default.jpg', 'upload/avatars/default.jpg');
                $model->img_path = 'default.jpg';
                $model->save();
            }
            if (isset(Yii::$app->request->post('ActorPresentation')['actor_id'])){
                foreach (Yii::$app->request->post('ActorPresentation')['actor_id'] as $actor){
                    $model_act_present = new ActorPresentation();
                    $model_act_present->actor_id = $actor;
                    $model_act_present->presentation_id = $model->attributes['id'];
                    $model_act_present->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    mkdir('upload/galleries/',0777, true);
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image){
                    $img_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new Image();
                    $model_image->presentation_id = $model->attributes['id'];
                    $model_image->image = $img_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/' . $img_name);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model, 'model_image' => $model_image, 'model_act_present' => $model_act_present
        ]);
    }

    /**
     * Updates an existing Presentation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_act_present = new ActorPresentation();
        $model_image = new Image();

        Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()['img_path']);

        if (Yii::$app->request->post('src')){
            $src = Yii::$app->request->post('src');
            $img = Image::find()->where(['image' => $src])->one();
            $img->delete();
            if (file_exists('upload/galleries/'.$src)){
                unlink('upload/galleries/'.$src);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                if (file_exists('upload/avatars/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                    $_SESSION['img_name'] !== 'default.jpg'){
                    unlink('upload/avatars/'.$_SESSION['img_name']);
                }
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $model->img_path = time() . '.' . $model->avatar_image->extension;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/' . time() . '.' . $model->avatar_image->extension);
            }else{
                if (file_exists('upload/avatars/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                    $_SESSION['img_name'] !== 'default.jpg'){
                    unlink('upload/avatars/'.$_SESSION['img_name']);
                }
                copy('image/default.jpg', 'upload/avatars/default.jpg');
                $model->img_path = 'default.jpg';
                $model->save();
            }

            ActorPresentation::deleteAll(['=', 'presentation_id', $id]);
            if (isset(Yii::$app->request->post('ActorPresentation')['actor_id'])){
                foreach (Yii::$app->request->post('ActorPresentation')['actor_id'] as $actor){
                    $model_act_present = new ActorPresentation();
                    $model_act_present->actor_id = $actor;
                    $model_act_present->presentation_id = $model->attributes['id'];
                    $model_act_present->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    mkdir('upload/galleries/',0777, true);
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image){
                    $img_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new Image();
                    $model_image->presentation_id = $model->attributes['id'];
                    $model_image->image = $img_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/' . $img_name);
                }
            }
            unset($_SESSION['img_name']);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $arr_actors = ArrayHelper::map(ActorPresentation::find()->where(['presentation_id' => $id])->all(), 'id', 'actor_id');
        $arr_actors_id = [];
        foreach ($arr_actors as $item){
            $arr_actors_id[] = $item;
        }
        $model_act_present->actor_id = $arr_actors_id;

        return $this->render('update', [
            'model' => $model, 'model_image' => $model_image, 'model_act_present' => $model_act_present
        ]);
    }

    /**
     * Deletes an existing Presentation model.
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
     * Finds the Presentation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presentation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presentation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
