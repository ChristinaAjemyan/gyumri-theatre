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
        $object = new $modelClass;
        $avatarName = $modelClass::find()->where(['id' => $id])->one()['img_path'];
        $avatarName && $avatarName !== 'default.jpg' ? $arr[0] = '/upload/avatars/'.$avatarName : $arr[0] = '';
        if (in_array('banner', array_keys($object->attributes))){
            $bannerName = $modelClass::find()->where(['id' => $id])->one()['banner'];
            $bannerName ? $arr[1] = '/upload/banners/'.$bannerName : $arr[1] = '';
        }
        return $arr;
    }
}
