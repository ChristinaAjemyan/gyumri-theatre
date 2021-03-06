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
        $this->view->title = Yii::t('home', 'Աշխատակազմ');
        $role_id = Role::find()->where(['name' => 'Դերասան'])->one()->id;

        $staff_primary = Staff::find()->where(['!=', 'role_id', $role_id])->andWhere(["primary_key" => 1])->
        andWhere(['is_member' => 1])->orderBy(['last_name' => SORT_ASC])->limit(2)->all();
        

        $staff_admin = Staff::find()->where(['!=', 'role_id', $role_id])->andWhere(['staff_status'=>'1'])->
        andWhere(['!=', 'primary_key', 1])->andWhere(['is_member' => 1])->orderBy(['last_name' => SORT_ASC]);
        $staff_artist = Staff::find()->where(['!=', 'role_id', $role_id])->andWhere(['staff_status'=>'2'])->
        andWhere(['!=', 'primary_key', 1])->andWhere(['is_member' => 1])->orderBy(['last_name' => SORT_ASC]);
        $pages_staff_admin = new Pagination([
            'totalCount' => $staff_admin->count(),
            'defaultPageSize' => 21,
            'params' => array_merge($_GET, ['role' => 'administrative'])
        ]);
        $pages_staff_artist = new Pagination([
            'totalCount' => $staff_artist->count(),
            'defaultPageSize' => 21,
            'params' => array_merge($_GET, ['role' => 'artistic'])
        ]);
        $model_staff_admin = $staff_admin->offset($pages_staff_admin->offset)
            ->limit($pages_staff_admin->limit)
            ->all();
        $model_staff_artist = $staff_artist->offset($pages_staff_artist->offset)
            ->limit($pages_staff_artist->limit)
            ->all();
        return $this->render('index',
            [
                'staff_primary' => $staff_primary,
                'model_staff_admin' => $model_staff_admin,
                'model_staff_artist' => $model_staff_artist,
                'pages_staff_admin' => $pages_staff_admin,
                'pages_staff_artist' => $pages_staff_artist
            ]
        );
    }

    public function actionActor()
    {
        $this->view->title = Yii::t('home', 'Դերասաններ');
        $role_id = Role::find()->where(['name' => 'Դերասան'])->one();
        $actors = Staff::find()->where(['role_id' => $role_id->id])->andWhere(['is_member' => 1]);
        $pages = new Pagination([
            'totalCount' => $actors->count(),
            'defaultPageSize' => 20,
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
        $this->view->title = Main::uppercaseNames($model->first_name) . ' ' . Main::uppercaseNames($model->last_name);
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
