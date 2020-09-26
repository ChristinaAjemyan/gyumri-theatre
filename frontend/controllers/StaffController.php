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
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class StaffController extends Controller
{
    public function actionIndex(){
        $this->view->title = 'Դերասաններ';
        $role_id = Role::find()->where(['name' => 'Դերասան'])->one();
        $actors = Staff::find()->where(['role_id' => $role_id->id]);
        $pages = new Pagination([
            'totalCount' => $actors->count(),
            'defaultPageSize' => 3,
        ]);
        $model = $actors->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',
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
        $this->view->title = 'Դերասան';

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
