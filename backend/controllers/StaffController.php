<?php

namespace backend\controllers;

use common\models\Main;
use common\models\SourceMessage;
use common\models\StaffImage;
use Yii;
use common\models\Staff;
use app\models\StaffSearch;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
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
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Staff model.
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
     * Creates a new Staff model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Staff();
        $model_image = new StaffImage();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            Main::createUploadDirectories('avatars/staff', ['original', '400', '200']);
            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();

                $model->avatar_image->saveAs('upload/avatars/staff/original/' . $img_name);
                Main::myResizeImage('avatars/staff', $img_name, ['400', '200']);
            }else{
                $model->img_path = 'default.jpg';
                $model->save();
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    FileHelper::createDirectory('upload/galleries/original/');
                    FileHelper::createDirectory('upload/galleries/250/');
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image ){
                    $image_name = time().rand(100, 999) . '.' . $image->extension;
                    $image->saveAs('upload/galleries/original/' . $image_name);
                    $model_image = new StaffImage();
                    $model_image->staff_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();

                    Main::myResizeImage('galleries', $image_name, ['250']);
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model, 'model_image' => $model_image
        ]);
    }

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_image = new StaffImage();

        Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()['img_path']);

        if (Yii::$app->request->post('src')){
            $src = Yii::$app->request->post('src');
            $img = StaffImage::find()->where(['image' => $src])->one();
            $img->delete();
            if (file_exists('upload/galleries/original/'.$src)){
                unlink('upload/galleries/original/'.$src);
                unlink('upload/galleries/250/'.$src);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (UploadedFile::getInstance($model, 'avatar_image')->name !== null){
                Main::unlinkImages('avatars/staff', ['original', '400', '200']);
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/staff/original/' . $img_name);
                Main::myResizeImage('avatars/staff', $img_name, ['400', '200']);
            }else{
                if (Yii::$app->request->post('token') !== null){
                    Main::unlinkImages('avatars/staff', ['original', '400', '200']);
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
                    $model_image = new StaffImage();
                    $model_image->staff_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/original/' . $image_name);
                    Main::myResizeImage('galleries', $image_name, ['250']);
                }
            }
            unset($_SESSION['img_name']);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model, 'model_image' => $model_image
        ]);
    }

    /**
     * Deletes an existing Staff model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = new Staff();
        Main::unlinkAllImagesById($model, $id, 'avatars/staff', ['200', '400', 'original']);
        $data = $this->findModel($id);
        $colData = [$data->first_name, $data->last_name, $data->country,
            $data->city, $data->staff_genre_type, $data->desc];
        foreach ($colData as $item){
            SourceMessage::deleteAll(['=', 'message', $item]);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Staff model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Staff the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
