<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 03.09.2020
 * Time: 16:03
 */

namespace app\models;


use Yii;
use yii\base\Model;


class Main extends Model
{
    public static function getInitialPreview($id, $model){
        $arr = [];
        $modelName = ucfirst($model->tableName());
        $modelClass =  "\app\models\\".$modelName;
        $imgName = $modelClass::find()->where(['id' => $id])->one()['img_path'];
        if ($imgName && $imgName !== 'default.jpg'){
            $arr[] = '/upload_avatars/'.$imgName;
            return $arr;
        }
        return false;
    }
}
