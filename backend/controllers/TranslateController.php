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
            Yii::$app->session->set('translate', $translate->id);

            return $this->redirect(['view', 'id' => $translate->id]);
        }

        return $this->render('create', [
            'translate' => $translate
        ]);
    }


    public function actionUpdate($id)
    {
        $update_translate = $this->findModel($id);
        $table_name = Yii::$app->request->get('table_name');
        $column_name = Yii::$app->request->get('column_name');
        $lang = Yii::$app->request->get('lang');
        $table_id = Yii::$app->request->get('table_id');

        if ($update_translate->load(Yii::$app->request->post())) {
            $i = 0;
            foreach (Yii::$app->request->post('Translate') as $item){
                $update_translate = $this->findModel($id + $i);
                $update_translate->table_name = $table_name;
                $update_translate->column_name = $column_name[$i];
                $update_translate->language = $lang;
                $update_translate->text = $item['text'];
                $update_translate->table_id = $table_id;
                $update_translate->save();
                $i++;
            }

            return $this->redirect(['view', 'id' => $update_translate->id]);
        }
        $update_lang = Translate::find()->where(['table_id' => $table_id,
                'language' => $lang, 'table_name' => $table_name])->all();

        return $this->render('update', [
            'update_lang' => $update_lang
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
