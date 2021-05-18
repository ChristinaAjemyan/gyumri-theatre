<?php

namespace backend\controllers;

use common\models\Main;
use common\models\SourceMessage;
use Yii;
use common\models\News;
use app\models\NewsSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->request->isAjax){
            foreach (Yii::$app->request->post('orderArray') as $key=>$value){
                if ($value!=null){
                    $model= News::findOne($key);
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
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            $model->show_type=Yii::$app->request->post("News")["show_type"];
            $model->reference_source=Yii::$app->request->post("News")["reference_source"];
            $model->source_url=Yii::$app->request->post("News")["source_url"];
            Main::createUploadDirectories('avatars/news', ['original', '200']);
            if (UploadedFile::getInstance($model, 'avatar_image')){
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name;
                $model->save();
                $model->avatar_image->saveAs('upload/avatars/news/original/' . $img_name);
                Main::myResizeImage('avatars/news', $img_name, ['200']);
            }else{
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
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Yii::$app->session->set('img_name', $model::find()->asArray()->where(['id' => $id])->one()['img_path']);

        if ($model->load(Yii::$app->request->post())) {
            $model->show_type=Yii::$app->request->post("News")["show_type"];
            $model->reference_source=Yii::$app->request->post("News")["reference_source"];
            $model->source_url=Yii::$app->request->post("News")["source_url"];
            if (UploadedFile::getInstance($model, 'avatar_image')){
                Main::unlinkImages('avatars/news', ['original', '200']);
                $model->avatar_image = UploadedFile::getInstance($model, 'avatar_image');
                $img_name = time() . '.' . $model->avatar_image->extension;
                $model->img_path = $img_name ;
                $model->save(false);
                $model->avatar_image->saveAs('upload/avatars/news/original/' . $img_name);
                Main::myResizeImage('avatars/news', $img_name, ['200']);
            }else{
                if (Yii::$app->request->post('token')){
                    Main::unlinkImages('avatars/news', ['original', '200']);
                    $model->img_path = 'default.jpg';
                    $model->save(false);
                }
            }
            $model->save();
            unset($_SESSION['img_name']);
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = new News();
        Main::unlinkAllImagesById($model, $id, 'avatars/news', ['200', 'original']);
        $data = $this->findModel($id);
        $colData = [$data->title, $data->content];
        foreach ($colData as $item){
            SourceMessage::deleteAll(['=', 'message', $item]);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
