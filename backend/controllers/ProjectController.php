<?php

namespace backend\controllers;


use common\models\Performance;
use common\models\ProjectImages;
use common\models\Main;
use common\models\ProjectVideos;
use common\models\Staff;
use Yii;
use common\models\Project;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find()->orderBy(['id'=>SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();
        if ($model->load(Yii::$app->request->post())) {
            Main::createUploadDirectories('avatars/project', ['original', '200']);
            $model->avatar_image = UploadedFile::getInstance($model, 'img_path');
            if ($model->avatar_image){
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->avatar_image->saveAs('upload/avatars/project/original/'.$img_name);
                Main::myResizeImage('avatars/project', $img_name, ['200']);
            }
            $model->banner_image = UploadedFile::getInstance($model, 'banner');
            if ($model->banner_image){
                $banner_img_name = time() .rand(11,99).'.'. $model->banner_image->extension;
                $model->banner = $banner_img_name;
                $model->banner_image->saveAs('upload/banners/'.$banner_img_name);
            }
            $model->save(false);
            $modelTwo=new ProjectImages();
            $modelTwo->image=UploadedFile::getInstances($modelTwo, 'file_path');

            if ($modelTwo->image){
                foreach ($modelTwo->image as $k=>$item){
                    $modelTwo= new ProjectImages();
                    $imgPath = time() .rand(100,999). '.' . $item->extension;
                    $modelTwo->project_id=$model->id;
                    $modelTwo->photo=$imgPath;
                    $modelTwo->save(false);
                    $item->saveAs('upload/avatars/project/original/'.$imgPath);
                    Main::myResizeImage('avatars/project', $imgPath, ['200']);
                }
            }
            if (YII::$app->request->post('ProjectVideo')['file_path'][0]!=''){
                foreach (YII::$app->request->post('ProjectVideo')['file_path'] as $k => $value) {
                    if ($value!=''){
                        $modelThree = new ProjectVideos();
                        $modelThree->project_id = $model->id;
                        $modelThree->video_url = $value;
                        $modelThree->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $avatar=$model->img_path;
        $banner=$model->banner;
        if ($model->load(Yii::$app->request->post())) {
            Main::createUploadDirectories('avatars/project', ['original', '200']);
            $model->avatar_image = UploadedFile::getInstance($model, 'img_path');
            if ($model->avatar_image){
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->avatar_image->saveAs('upload/avatars/project/original/'.$img_name);
                Main::myResizeImage('avatars/project', $img_name, ['200']);
            }else{
                $model->img_path=$avatar;
            }
            $model->banner_image = UploadedFile::getInstance($model, 'banner');
            if ($model->banner_image){
                $banner_img_name = time() .rand(11,99).'.'. $model->banner_image->extension;
                $model->banner = $banner_img_name;
                $model->banner_image->saveAs('upload/banners/'.$banner_img_name);
            }else{
                $model->banner=$banner;
            }

            $model->save(false);
            $removeMultipleImgId=explode(',',Yii::$app->request->post("removeImgIdArray")[0]);
            ProjectImages::deleteAll(['id'=>$removeMultipleImgId]);
            $modelTwo=new ProjectImages();
            $modelTwo->image=UploadedFile::getInstances($modelTwo, 'file_path');

            if ($modelTwo->image){
                foreach ($modelTwo->image as $k=>$item){
                    $modelTwo= new ProjectImages();
                    $imgPath = time() .rand(100,999). '.' . $item->extension;
                    $modelTwo->project_id=$model->id;
                    $modelTwo->photo=$imgPath;
                    $modelTwo->save(false);
                    $item->saveAs('upload/avatars/project/original/'.$imgPath);
                    Main::myResizeImage('avatars/project', $imgPath, ['200']);
                }
            }
            $removeMultipleVideoId=explode(',',Yii::$app->request->post("videoRemoveId")[0]);
            ProjectVideos::deleteAll(['id'=>$removeMultipleVideoId]);
            if (YII::$app->request->post('ProjectVideo')['file_path'][0]!=''){
                foreach (YII::$app->request->post('ProjectVideo')['file_path'] as $k => $value) {
                    if ($value!=''){
                        $modelThree = new ProjectVideos();
                        $modelThree->project_id = $model->id;
                        $modelThree->video_url = $value;
                        $modelThree->save(false);
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
