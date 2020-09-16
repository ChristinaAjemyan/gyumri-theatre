<?php

namespace backend\controllers;

use Yii;
use app\models\Translate;
use app\models\TranslateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TranslateController implements the CRUD actions for Translate model.
 */
class TranslateController extends Controller
{
    /**
     * Displays a single Translate model.
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

    public function actionCreate()
    {
        $translate = new Translate();

        if ($translate->load(Yii::$app->request->post())) {
            $i = 0;
            foreach (Yii::$app->request->post('Translate') as $item){
                $translate = new Translate();
                $translate->table_name = Yii::$app->request->get('table_name');
                $translate->column_name = Yii::$app->request->get('column_name')[$i];
                $translate->language = Yii::$app->request->get('lang');
                $translate->text = $item['text'];
                $translate->table_id = Yii::$app->request->get('table_id');
                $translate->save();
                $i++;
            }


            return $this->redirect(['view', 'id' => $translate->id]);
        }

        return $this->render('create', [
            'translate' => $translate
        ]);
    }


    public function actionUpdate($id)
    {
        $update_translate = $this->findModel($id);
        if ($update_translate->load(Yii::$app->request->post())) {
            $i = 0;
            foreach (Yii::$app->request->post('Translate') as $item){
                $update_translate = $this->findModel($id);
                $update_translate->table_name = Yii::$app->request->get('table_name');
                $update_translate->column_name = Yii::$app->request->get('column_name')[$i];
                $update_translate->language = Yii::$app->request->get('lang');
                $update_translate->text = $item['text'];
                $update_translate->table_id = Yii::$app->request->get('table_id');
                $update_translate->save();
                $i++;
            }

            return $this->redirect(['view', 'id' => $update_translate->id]);
        }

        return $this->render('update', [
            'update_translate' => $update_translate
        ]);
    }
    /**
     * Finds the Translate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Translate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Translate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
