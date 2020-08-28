<?php

namespace backend\controllers;

use app\models\ActorPresentation;
use Yii;
use app\models\Presentation;
use app\models\PresentationSearch;
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

                                                
            if (Yii::$app->session->has('img_name') || Yii::$app->session->has('img_field_name')){
                unset($_SESSION['img_name']);
                unset($_SESSION['img_field_name']);
            }
                                                                                                
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



        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            if (!is_dir('uploads/')){
                mkdir('uploads/',0777, true);

            }
            foreach ($model->attributes['actors_id'] as $actor){
                $model_act_present = new ActorPresentation();
                $model_act_present->actor_id = $actor;
                $model_act_present->presentation_id = $model->attributes['id'];
                $model_act_present->save();
            }
            if (UploadedFile::getInstance($model, 'file')->name !== null){

                foreach (array_keys($model->attributes) as $item){
                    if (preg_match('/^(img_path|path|img|image|images|photo|upload|uploads|file)$/i', $item)) {
                        $model->file = UploadedFile::getInstance($model, 'file');
                        $model->file->saveAs('uploads/' . date('dhis') . '.' . $model->file->extension);
                        $model->$item = date('dhis') . '.' . $model->file->extension;
                        $model->save();
                    }
                }
            }else{
                foreach (array_keys($model->attributes) as $item){
                    if (preg_match('/^(img_path|path|img|image|images|photo|upload|uploads|file)$/i', $item)) {
                        copy('image/default.jpg', 'uploads/default.jpg');
                        $model->$item = 'default.jpg';
                        $model->save();
                    }
                }
            }

            if ($model->actors_id){
                $model->actors_id = implode(',', $model->actors_id);
            }
            $model->save();
                                                                                                
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
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

        foreach (array_keys($model::find()->asArray()->where(['id' => $id])->one()) as $item){
            if (preg_match('/^(img_path|path|img|image|images|photo|upload|uploads|file)$/i', $item)) {
                Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()[$item]);
                Yii::$app->session->set('img_field_name', $item);
            }
        }
        $imgField = Yii::$app->session->get('img_field_name');
        if (Yii::$app->request->isAjax){
            if (file_exists('uploads/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null){
                unlink('uploads/'.$_SESSION['img_name']);
            }
            $model::findOne($id);
            $model->$imgField = 'default.jpg';
            $model->save();
        }
                                                                                                
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            ActorPresentation::deleteAll(['=', 'presentation_id', $id]);
            foreach ($model->attributes['actors_id'] as $actor){
                $model_act_present = new ActorPresentation();
                $model_act_present->actor_id = $actor;
                $model_act_present->presentation_id = $model->attributes['id'];
                $model_act_present->save();
            }

            if (UploadedFile::getInstance($model, 'file')->name !== null){
                if (file_exists('uploads/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                $_SESSION['img_name'] !== 'default.jpg'){
                    unlink('uploads/'.$_SESSION['img_name']);
                }
                $model->file = UploadedFile::getInstance($model, 'file');
                $model->file->saveAs('uploads/' . date('dhis') . '.' . $model->file->extension);
                $model->$imgField = date('dhis') . '.' . $model->file->extension;
                $model->save();
            }
            unset($_SESSION['img_name']);
            unset($_SESSION['img_field_name']);

            if ($model->actors_id){
                $model->actors_id = implode(',', $model->actors_id);
            }
            $model->save();
                                                                                                                                                
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->actors_id = explode(',', $model->actors_id);

        return $this->render('update', [
            'model' => $model,
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
