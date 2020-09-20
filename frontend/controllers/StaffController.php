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
use yii\web\Controller;

class StaffController extends Controller
{
    public function actionIndex(){
        $this->view->title = 'Դերասաններ';
        $role_id = Role::find()->where(['name' => 'Դերասան'])->one();
        $actors = Staff::find()->where(['role_id' => $role_id->id])->all();

        return $this->render('index',
            ['actors' => $actors]
        );
    }

    public function actionView(){
        $this->view->title = 'Դերասան';

        return $this->render('view');
    }
}
