<?php

namespace backend\controllers;

use common\models\GenrePerformance;
use common\models\Main;
use common\models\SourceMessage;
use common\models\StaffPerformance;
use common\models\Image;
use common\models\TypePerformance;
use common\models\Videolink;
use Yii;
use common\models\Performance;
use app\models\PerformanceSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Json;
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'delete-videolink'],
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
        if (Yii::$app->request->isAjax){
            foreach (Yii::$app->request->post('orderArray') as $key=>$value){
                if ($value!=null){
                    $model= Performance::findOne($key);
                    $model->ordering=$value;
                    $model->save(false);
                }
            }
            echo Json::encode(true);die;
        }
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
        $model_stf_perform = new StaffPerformance();
        $model_image = new Image();
        $model_genre_perform = new GenrePerformance();
        $model_type_perform = new TypePerformance();
        $model_videolink_perform = new Videolink();

        if ($model->load(Yii::$app->request->post())) {
            Main::createUploadDirectories('avatars/performance', ['original', '400', '200']);

            if (!is_dir('upload/banners/')) {
                FileHelper::createDirectory('upload/banners/');
            }
            if (!is_dir('upload/mobile_banners/')) {
                FileHelper::createDirectory('upload/mobile_banners/');
            }

            $imgAvatar = UploadedFile::getInstance($model, 'avatar_image');
            $imgBanner = UploadedFile::getInstance($model, 'banner_image');
            $imgBannerMobile = UploadedFile::getInstance($model, 'mobile_banner_image');

            if ($imgAvatar && ($imgBanner && $imgBannerMobile)) {
                $arr_dir = [];
                $imageArray = ['avatar_image', 'banner_image','mobile_banner_image'];
                foreach ($imageArray as $item) {
                    $model->$item = UploadedFile::getInstance($model, $item);
                    $avatar_name = time() . rand(100, 999) . '.' . $model->$item->extension;
                    $banner_name = time() . rand(100, 999) . '.' . $model->$item->extension;
                    $mobile_banner_name = time() . rand(100, 999) . '.' . $model->$item->extension;
                    $arr_dir[0] = $avatar_name;
                    $arr_dir[1] = $banner_name;
                    $arr_dir[2] = $mobile_banner_name;
                    $model->img_path = $avatar_name;
                    $model->banner = $banner_name;
                    $model->mobile_banner = $mobile_banner_name;
                    $model->ordering=0;
                    $model->save();
                }
                foreach ($imageArray as $value) {
                    $model->$value = UploadedFile::getInstance($model, $value);
                    if ($value == 'avatar_image') {
                        $model->$value->saveAs('upload/avatars/performance/original/' . $arr_dir[0]);
                    }
                    if ($value == 'banner_image') {
                        $model->$value->saveAs('upload/banners/' . $arr_dir[1]);
                    }
                    if ($value == 'mobile_banner_image') {
                        $model->$value->saveAs('upload/mobile_banners/' . $arr_dir[2]);
                    }
                }
                Main::myResizeImage('avatars/performance', $arr_dir[0], ['400', '200']);
            } elseif ($imgAvatar && (!$imgBanner && !$imgBannerMobile)) {
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/performance/original/' . $img_name);
                Main::myResizeImage('avatars/performance', $img_name, ['400', '200']);
            } elseif (!$imgAvatar && ($imgBanner && $imgBannerMobile)) {
                $model->img_path = 'default.jpg';
                $model->banner_image = UploadedFile::getInstance($model, 'banner_image');
                $model->mobile_banner_image = UploadedFile::getInstance($model, 'mobile_banner_image');
                $img_name = time() . '.' . $model->banner_image->extension;
                $mob_img_name = time() . '.' . $model->mobile_banner_image->extension;
                $model->banner = $img_name;
                $model->mobile_banner = $mob_img_name;
                $model->save();
                $model->banner_image->saveAs('upload/banners/' . $img_name);
                $model->mobile_banner_image->saveAs('upload/mobile_banners/' . $mob_img_name);
            } else {
                $model->img_path = 'default.jpg';
                $model->save();
            }

            if (isset(Yii::$app->request->post('StaffPerformance')['staff_id'])) {
                foreach (Yii::$app->request->post('StaffPerformance')['staff_id'] as $staff) {
                    $model_stf_present = new StaffPerformance();
                    $model_stf_present->staff_id = $staff;
                    $model_stf_present->performance_id = $model->attributes['id'];
                    $model_stf_present->save();
                }
            }

            if (isset(Yii::$app->request->post('GenrePerformance')['genre_id'])) {
                foreach (Yii::$app->request->post('GenrePerformance')['genre_id'] as $genre) {
                    $model_genre_perform = new GenrePerformance();
                    $model_genre_perform->genre_id = $genre;
                    $model_genre_perform->performance_id = $model->attributes['id'];
                    $model_genre_perform->save();
                }
            }

            $type_id = Yii::$app->request->post('TypePerformance')['type_id'];

            if (isset($type_id) && is_array($type_id)) {
                foreach (Yii::$app->request->post('TypePerformance')['type_id'] as $type) {
                    $model_type_perform = new TypePerformance();
                    $model_type_perform->type_id = $type;
                    $model_type_perform->performance_id = $model->attributes['id'];
                    $model_type_perform->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')) {
                if (!is_dir('upload/galleries/')) {
                    FileHelper::createDirectory('upload/galleries/original/');
                    FileHelper::createDirectory('upload/galleries/250/');
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image) {
                    $image_name = time() . rand(100, 999) . '.' . $image->extension;
                    $model_image = new Image();
                    $model_image->performance_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/original/' . $image_name);
                    Main::myResizeImage('galleries', $image_name, ['250']);
                }
            }
            if (!is_null(Yii::$app->request->post("Videolink")['link'])){
                $links = Yii::$app->request->post("Videolink")['link'];
                $filtered_links = array_filter($links, function($value) { return !is_null($value) && $value !== ''; });

                foreach ($filtered_links as $item){
                    $links_model = new Videolink();
                    $links_model->performance_id = $model->attributes['id'];
                    $links_model->link = $item ? $item : false;
                    $links_model->save(false);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model, 'model_image' => $model_image,
            'model_stf_perform' => $model_stf_perform, 'model_genre_perform' => $model_genre_perform,
            'model_type_perform' => $model_type_perform, 'model_videolink_perform' => $model_videolink_perform
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
        $model_stf_perform = new StaffPerformance();
        $model_image = new Image();
        $model_genre_perform = new GenrePerformance();
        $model_type_perform = new TypePerformance();
        $model_videolink_perform = new Videolink();

        Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()['img_path']);
        Yii::$app->session->set('banner', $model::find()->asArray()->where(['id' => $id])->one()['banner']);
        Yii::$app->session->set('mobile_banner', $model::find()->asArray()->where(['id' => $id])->one()['mobile_banner']);

        if (Yii::$app->request->post('src')){
            $src = Yii::$app->request->post('src');
            $img = Image::find()->where(['image' => $src])->one();
            $img->delete();
            if (file_exists('upload/galleries/original/'.$src)){
                unlink('upload/galleries/original/'.$src);
                unlink('upload/galleries/250/'.$src);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $imgAvatar = UploadedFile::getInstance($model, 'avatar_image');
            $imgBanner = UploadedFile::getInstance($model, 'banner_image');
            $imgBannerMobile = UploadedFile::getInstance($model, 'mobile_banner_image');


            if ($imgAvatar || $imgBanner || $imgBannerMobile){

                $arr_dir = [];
                $imageArray = [];

                if($imgAvatar)$imageArray[]='avatar_image';
                if($imgBanner)$imageArray[]='banner_image';
                if($imgBannerMobile)$imageArray[]='mobile_banner_image';

                foreach ($imageArray as $item){
                    $model->$item = UploadedFile::getInstance($model, $item);
                    if($imgAvatar){
                        $avatar_name = time().rand(100, 999) . '.' . $model->$item->extension;
                        $arr_dir[0] = $avatar_name;
                        $model->img_path = $avatar_name;
                        $model->save();
                        $model->$item->saveAs('upload/avatars/performance/original/' . $arr_dir[0]);
                        Main::myResizeImage('avatars/performance', $arr_dir[0], ['400', '200']);
                    }
                    if($imgBanner){
                        $banner_name = time().rand(100, 999) . '.' . $model->$item->extension;
                        $arr_dir[1] = $banner_name;
                        $model->banner = $banner_name;
                        $model->save();
                        $model->$item->saveAs('upload/banners/' . $arr_dir[1]);
                    }
                    if($imgBannerMobile){
                        $mobile_banner_name = time().rand(100, 999) . '.' . $model->$item->extension;
                        $arr_dir[2] = $mobile_banner_name;
                        $model->mobile_banner = $mobile_banner_name;
                        $model->save();
                        $model->$item->saveAs('upload/mobile_banners/' . $arr_dir[2]);
                    }
                }

            }else{
                if (Yii::$app->request->post('token1') == 1){
                    Main::unlinkImages('avatars/performance', ['original', '400', '200']);
                    $model->img_path = 'default.jpg';
                    $model->save();
                }
                if (Yii::$app->request->post('token2') == 2){
                    if ($_SESSION['banner'] && file_exists('upload/banners/'.$_SESSION['banner'])){
                        unlink('upload/banners/'.$_SESSION['banner']);
                    }
                    if ($_SESSION['mobile_banner'] && file_exists('upload/mobile_banners/'.$_SESSION['mobile_banner'])){
                        unlink('upload/mobile_banners/'.$_SESSION['mobile_banner']);
                    }
                    $model->banner = null;
                    $model->mobile_banner = null;
                    $model->save();
                }
            }

            StaffPerformance::deleteAll(['=', 'performance_id', $id]);
            if (!empty(Yii::$app->request->post('StaffPerformance')['staff_id'])){
                foreach (Yii::$app->request->post('StaffPerformance')['staff_id'] as $staff){
                    $model_stf_present = new StaffPerformance();
                    $model_stf_present->staff_id = $staff;
                    $model_stf_present->performance_id = $model->attributes['id'];
                    $model_stf_present->save();
                }
            }

            GenrePerformance::deleteAll(['=', 'performance_id', $id]);
            if (!empty(Yii::$app->request->post('GenrePerformance')['genre_id'])){
                foreach (Yii::$app->request->post('GenrePerformance')['genre_id'] as $genre){
                    $model_genre_perform = new GenrePerformance();
                    $model_genre_perform->genre_id = $genre;
                    $model_genre_perform->performance_id = $model->attributes['id'];
                    $model_genre_perform->save();
                }
            }

            TypePerformance::deleteAll(['=', 'performance_id', $id]);
            if (!empty(Yii::$app->request->post('TypePerformance')['type_id'])){
                foreach (Yii::$app->request->post('TypePerformance')['type_id'] as $type){
                    $model_type_perform = new TypePerformance();
                    $model_type_perform->type_id = $type;
                    $model_type_perform->performance_id = $model->attributes['id'];
                    $model_type_perform->save();
                }
            }

            if (UploadedFile::getInstances($model_image, 'image')){
                if (!is_dir('upload/galleries/')){
                    mkdir('upload/galleries/',0777, true);
                    FileHelper::createDirectory('upload/galleries/original/');
                    FileHelper::createDirectory('upload/galleries/250/');
                }
                $images = UploadedFile::getInstances($model_image, 'image');
                foreach ($images as $image){
                    $image_name = time().rand(100, 999) . '.' . $image->extension;
                    $model_image = new Image();
                    $model_image->performance_id = $model->attributes['id'];
                    $model_image->image = $image_name;
                    $model_image->save();
                    $image->saveAs('upload/galleries/original/' . $image_name);
                    Main::myResizeImage('galleries', $image_name, ['250']);
                }
            }

            if (!is_null(Yii::$app->request->post("Videolink")['link'])){
                $links = Yii::$app->request->post("Videolink")['link'];
                $filtered_links = array_filter($links, function($value) { return !is_null($value) && $value !== ''; });

                foreach ($filtered_links as $item){
                    $links_model = new Videolink();
                    $links_model->performance_id = $id;
                    $links_model->link = $item ? $item : false;
                    $links_model->save(false);
                }
            }

            unset($_SESSION['img_name']);
            unset($_SESSION['banner']);
            unset($_SESSION['mobile_banner']);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $arr_staff = ArrayHelper::map(StaffPerformance::find()->where(['performance_id' => $id])->all(), 'id', 'staff_id');
        $arr_genre = ArrayHelper::map(GenrePerformance::find()->where(['performance_id' => $id])->all(), 'id', 'genre_id');
        $arr_type = ArrayHelper::map(TypePerformance::find()->where(['performance_id' => $id])->all(),'id','type_id');
        $arr_staff_id = []; $arr_genre_id = []; $arr_type_id = [];
        foreach ($arr_staff as $item){
            $arr_staff_id[] = $item;
        }
        $model_stf_perform->staff_id = $arr_staff_id;
        foreach ($arr_genre as $item){
            $arr_genre_id[] = $item;
        }
        $model_genre_perform->genre_id = $arr_genre_id;
        foreach ($arr_type as $item){
            $arr_type_id[] = $item;
        }
        $model_type_perform->type_id = $arr_type_id;

        return $this->render('update', [
            'model' => $model, 'model_image' => $model_image,
            'model_stf_perform' => $model_stf_perform, 'model_genre_perform' => $model_genre_perform,
            'model_type_perform' => $model_type_perform,'model_videolink_perform' => $model_videolink_perform
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
        $model = new Performance();
        Main::unlinkAllImagesById($model, $id, 'avatars/performance', ['200', '400', 'original']);
        Main::unlinkAllImagesById($model, $id, 'galleries', ['250', 'original']);
        Main::unlinkAllImagesById($model, $id, 'banners');
        $data = $this->findModel($id);
        $colData = [$data->title, $data->author, $data->short_desc, $data->desc];
        foreach ($colData as $item){
            SourceMessage::deleteAll(['=', 'message', $item]);
        }
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

    public function actionDeleteVideolink(){
        if (Yii::$app->request->post('link')){
            $link = Yii::$app->request->post('link');
            $link = Videolink::find()->where(['link' => $link])->one();
            $link->delete();
        }
    }
}
