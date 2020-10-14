<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 20.09.2020
 * Time: 12:24
 */

namespace frontend\controllers;


use common\models\Main;
use common\models\Message;
use common\models\Role;
use common\models\SourceMessage;
use common\models\Staff;
use common\models\StaffImage;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StaffController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = Yii::t('home', 'Վարչական մաս');
        $role_id = Role::find()->where(['name' => 'Դերասան'])->one()->id;
        $staff = Staff::find()->where(['!=', 'role_id', $role_id])->orderBy(['last_name' => SORT_ASC]);
        $pages = new Pagination([
            'totalCount' => $staff->count(),
            'defaultPageSize' => 15,
        ]);
        $model = $staff->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index',
            [
                'model' => $model,
                'pages' => $pages
            ]
        );
    }

    public function actionActor()
    {
        $this->view->title = Yii::t('home', 'Դերասաններ');
        $role_id = Role::find()->where(['name' => 'Դերասան'])->one();
        $actors = Staff::find()->where(['role_id' => $role_id->id]);
        $pages = new Pagination([
            'totalCount' => $actors->count(),
            'defaultPageSize' => 15,
        ]);
        $model = $actors->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('actor',
            [
                'model' => $model,
                'pages' => $pages
            ]
        );
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        $cookieLanguage = Yii::$app->request->cookies->getValue('language');
        if ($cookieLanguage == 'ru' || $cookieLanguage == 'en') {
            $message_id = Message::find()->where(['translation' => $slug])->one()->id;
            $source_message = SourceMessage::find()->where(['id' => $message_id])->one()->message;
            $model = Staff::find()->where(['slug' => $source_message])->one();
        } else {
            $model = Staff::find()->where(['slug' => $slug])->one();
        }
        $this->view->title = Main::uppercaseFirstLetter($model->first_name) . ' ' . Main::uppercaseFirstLetter($model->last_name);
        empty($model) ? $this->goHome() : false;

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
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
