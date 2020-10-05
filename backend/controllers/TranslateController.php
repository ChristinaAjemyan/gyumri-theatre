<?php

namespace backend\controllers;

use common\models\Message;
use common\models\SourceMessage;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TranslateController implements the CRUD actions for Translate model.
 */
class TranslateController extends Controller
{
    public function actionCreate()
    {
        $message = new Message();
        if ($message->load(Yii::$app->request->post())) {
            $arrMessage = ArrayHelper::map(SourceMessage::find()->all(), 'id', 'message');
            $id = Yii::$app->request->get('id');
            $table_name = Yii::$app->request->get('table_name');
            $lang = Yii::$app->request->get('lang');
            $modelName = ucfirst($table_name);
            $modelClass =  "\common\models\\".$modelName;
            $arr = [];
            $arrColumnName = ''; $translation_id = '';
            foreach (Yii::$app->request->get('col') as $value){
                $sourceMessage = new SourceMessage();
                $sourceMessage->category = 'text';
                $sourceMessage->message = $modelClass::findOne($id)->$value;
                if (!in_array($modelClass::findOne($id)->$value, $arrMessage)){
                    $sourceMessage->save();
                }
                $arr[] = SourceMessage::find()->where(['message' => $sourceMessage->message])->one()->id;
                $arrColumnName .= "col[]=$value&";
                $columnName = trim($arrColumnName, '&');
                $translation_id .= "tr_id[]=".SourceMessage::find()->where(['message' => $sourceMessage->message])->one()->id."&";
                $tr_id = trim($translation_id, '&');
            }
            foreach (Yii::$app->request->post('Message') as $key => $item){
                $message = new Message();
                $message->id = $arr[$key];
                $message->language = $lang;
                $message->translation = $item['translation'];
                $message->save();
            }
            Yii::$app->session->set('message', $message->id);
            Yii::$app->session->set('lang', $lang);
            Yii::$app->session->setFlash('success', 'Translate confirmed!');
            return $this->redirect("/translate/update?id=$id&lang=$lang&table_name=$table_name&$columnName&$tr_id");
        }

        return $this->render('create', [
            'message' => $message
        ]);
    }

    public function actionUpdate($id)
    {
        $message = new Message();
        $lang = Yii::$app->request->get('lang');
        $tr_id = Yii::$app->request->get('tr_id');
        if ($message->load(Yii::$app->request->post())) {
            foreach (Yii::$app->request->post('Message') as $key => $item){
                $message_model = Message::find()->where(['id' => $tr_id[$key], 'language' => $lang])->all()[0];
                $message_model->language = $lang;
                $message_model->translation = $item['translation'];
                $message_model->save();
            }
            Yii::$app->session->setFlash('success', 'Translate confirmed!');
            return $this->redirect(Yii::$app->request->referrer);
        }
        $arrTranslations = [];
        foreach ($tr_id as $value){
            $arrTranslations[] = Message::find()->where(['id' => $value, 'language' => $lang])->all()[0];
        }
        return $this->render('update', [
            'update_lang' => $arrTranslations
        ]);
    }


    /**
     * Finds the Translate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
