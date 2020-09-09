<?php

namespace backend\controllers;

use app\models\StaffPerformance;
use app\models\Image;
use Yii;
use app\models\Performance;
use app\models\PerformanceSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * PerformanceController implements the CRUD actions for Performance model.
 */
class PerformanceController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view'],
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
     * Lists all Performance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PerformanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Performance model.
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
     * Creates a new Performance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Performance();
        $model_stf_present = new StaffPerformance();
        $model_image = new Image();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            if (!is_dir('upload/avatars/')){
//                mkdir('upload/avatars/',0777, true);
                FileHelper::createDirectory('upload/avatars/');
            }
            $arr_dir = [];
            $imageArray = ['avatar_image','banner_image'];
            foreach ($imageArray as $item){
                $model->$item = UploadedFile::getInstance($model, $item);
                $avatar_name = time().rand(100, 999) . '.' . $model->$item->extension;
                $banner_name = time().rand(100, 999) . '.' . $model->$item->extension;
                $arr_dir[0] = $avatar_name;
                $arr_dir[1] = $banner_name;
                $model->img_path = $avatar_name;
                $model->banner = $banner_name;
                $model->save();
            }

            foreach ($imageArray as $value){
                $model->$value = UploadedFile::getInstance($model, $value);
                if ($value == 'avatar_image'){
                    $model->$value->saveAs('upload/avatars/' . $arr_dir[0]);
                }
                if ($value == 'banner_image'){
                    $model->$value->saveAs('upload/banners/' . $arr_dir[1]);
                }
            }






            //avatars
/*            if (!is_dir('upload/avatars/')){
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
            }*/
            //banner
/*            if (!is_dir('upload/banners/')){
                mkdir('upload/banners/',0777, true);
            }
            if (UploadedFile::getInstance($model, 'banner_image')->name !== null){
                $model->banner_image = UploadedFile::getInstance($model, 'banner_image');
                //var_dump(UploadedFile::getInstance($model, 'banner_image')->name);die;
                $img_name = time().rand(100, 999) . '.' . $model->banner_image->extension;
                $model->banner = $img_name;
                $model->save();
                $model->banner_image->saveAs('upload/banners/' . $img_name);
            }*/
/*            else{
                copy('image/default.jpg', 'upload/avatars/default.jpg');
                $model->img_path = 'default.jpg';
                $model->save();
            }*/
            if (isset(Yii::$app->request->post('StaffPerformance')['staff_id'])){
                foreach (Yii::$app->request->post('StaffPerformance')['staff_id'] as $staff){
                    $model_stf_present = new StaffPerformance();
                    $model_stf_present->staff_id = $staff;
                    $model_stf_present->performance_id = $model->attributes['id'];
                    $model_stf_present->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    mkdir('upload/galleries/',0777, true);
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image){
                    $image_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new Image();
                    $model_image->performance_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/' . $image_name);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model, 'model_image' => $model_image, 'model_stf_present' => $model_stf_present
        ]);
    }

    /**
     * Updates an existing Performance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_stf_present = new StaffPerformance();
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

            StaffPerformance::deleteAll(['=', 'performance_id', $id]);
            if (isset(Yii::$app->request->post('StaffPerformance')['staff_id'])){
                foreach (Yii::$app->request->post('StaffPerformance')['staff_id'] as $staff){
                    $model_stf_present = new StaffPerformance();
                    $model_stf_present->staff_id = $staff;
                    $model_stf_present->performance_id = $model->attributes['id'];
                    $model_stf_present->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    mkdir('upload/galleries/',0777, true);
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image){
                    $image_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new Image();
                    $model_image->performance_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/' . $image_name);
                }
            }
            unset($_SESSION['img_name']);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $arr_staff = ArrayHelper::map(StaffPerformance::find()->where(['performance_id' => $id])->all(), 'id', 'staff_id');
        $arr_staff_id = [];
        foreach ($arr_staff as $item){
            $arr_staff_id[] = $item;
        }
        $model_stf_present->staff_id = $arr_staff_id;

        return $this->render('update', [
            'model' => $model, 'model_image' => $model_image, 'model_stf_present' => $model_stf_present
        ]);
    }

    /**
     * Deletes an existing Performance model.
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
     * Finds the Performance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Performance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Performance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
