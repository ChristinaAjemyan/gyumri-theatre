<?php

namespace backend\controllers;

use common\models\ArchiveImage;
use common\models\ArchivePerformance;
use common\models\Main;
use common\models\SourceMessage;
use Yii;
use common\models\Archive;
use app\models\ArchiveSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArchiveController implements the CRUD actions for Archive model.
 */
class ArchiveController extends Controller
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
     * Lists all Archive models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArchiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Archive model.
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
     * Creates a new Archive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Archive();
        $model_image = new ArchiveImage();
        $model_archive_perform = new ArchivePerformance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Main::createUploadDirectories('avatars/archive', ['original', '200']);

            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/archive/original/' . $img_name);
                Main::myResizeImage('avatars/archive', $img_name, ['200']);
            }else{
                $model->img_path = 'default.jpg';
                $model->save();
            }

            if (UploadedFile::getInstances($model_image,'image')){
                if (!is_dir('upload/galleries/')){
                    FileHelper::createDirectory('upload/galleries/original/');
                    FileHelper::createDirectory('upload/galleries/250/');
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image ){
                    $image_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new ArchiveImage();
                    $model_image->archive_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/original/' . $image_name);
                    Main::myResizeImage('galleries', $image_name, ['250']);
                }
            }

            if (isset(Yii::$app->request->post('ArchivePerformance')['performance_id'])){
                foreach (Yii::$app->request->post('ArchivePerformance')['performance_id'] as $performance){
                    $model_archive_perform = new ArchivePerformance();
                    $model_archive_perform->performance_id = $performance;
                    $model_archive_perform->archive_id = $model->attributes['id'];
                    $model_archive_perform->save();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'model_image' => $model_image,
            'model_archive_perform' => $model_archive_perform
        ]);
    }

    /**
     * Updates an existing Archive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_image = new ArchiveImage();
        $model_archive_perform = new ArchivePerformance();

        Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()['img_path']);

        if (Yii::$app->request->post('src')){
            $src = Yii::$app->request->post('src');
            $img = ArchiveImage::find()->where(['image' => $src])->one();
            $img->delete();
            if (file_exists('upload/galleries/original/'.$src)){
                unlink('upload/galleries/original/'.$src);
                unlink('upload/galleries/250/'.$src);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                Main::unlinkImages('avatars/archive', ['original', '200']);
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name ;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/archive/original/' . $img_name);
                Main::myResizeImage('avatars/archive', $img_name, ['200']);
            }else{
                if (Yii::$app->request->post('token') !== null){
                    Main::unlinkImages('avatars/archive', ['original', '200']);
                    $model->img_path = 'default.jpg';
                    $model->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    FileHelper::createDirectory('upload/galleries/original/');
                    FileHelper::createDirectory('upload/galleries/250/');
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image){
                    $image_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new ArchiveImage();
                    $model_image->archive_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/original/' . $image_name);
                    Main::myResizeImage('galleries', $image_name, ['250']);
                }
            }

            ArchivePerformance::deleteAll(['=', 'archive_id', $id]);
            if (isset(Yii::$app->request->post('ArchivePerformance')['performance_id'])){
                foreach (Yii::$app->request->post('ArchivePerformance')['performance_id'] as $performance){
                    $model_archive_perform = new ArchivePerformance();
                    $model_archive_perform->performance_id = $performance;
                    $model_archive_perform->archive_id = $model->attributes['id'];
                    $model_archive_perform->save();
                }
            }

            unset($_SESSION['img_name']);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $arr_performance = ArrayHelper::map(ArchivePerformance::find()->where(['archive_id' => $id])->all(), 'id', 'performance_id');

        $arr_performance_id = [];
        foreach ($arr_performance as $item){
            $arr_performance_id[] = $item;
        }
        $model_archive_perform->performance_id = $arr_performance_id;


        return $this->render('update', [
            'model' => $model,
            'model_image' => $model_image,
            'model_archive_perform' => $model_archive_perform
        ]);
    }

    /**
     * Deletes an existing Archive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = new Archive();
        Main::unlinkAllImagesById($model, $id, 'avatars/archive', ['200', 'original']);
        $data = $this->findModel($id);
        $colData = [$data->title, $data->content];
        foreach ($colData as $item){
            SourceMessage::deleteAll(['=', 'message', $item]);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Archive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Archive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Archive::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
