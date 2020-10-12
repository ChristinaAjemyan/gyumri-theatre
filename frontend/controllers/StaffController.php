<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 20.09.2020
 * Time: 12:24
 */

namespace frontend\controllers;


use common\models\Role;
use common\models\Staff;
use common\models\StaffImage;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StaffController extends Controller
{
    public function actionIndex(){
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

    public function actionActor(){
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
    public function actionView($id){
        $this->view->title = Yii::t('text', $this->findModel($id)->first_name).' '.Yii::t('text', $this->findModel($id)->last_name);

        return $this->render('view', [
            'model' => $this->findModel($id),
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
