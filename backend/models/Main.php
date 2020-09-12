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
use yii\helpers\FileHelper;
use yii\imagine\Image;


class Main extends Model
{
    public static function getInitialPreview($id, $model, $path){
        $arr = [];
        $modelName = ucfirst($model->tableName());
        $modelClass =  "\app\models\\".$modelName;
        $object = new $modelClass;
        $avatarName = $modelClass::find()->where(['id' => $id])->one()['img_path'];
        $avatarName && $avatarName !== 'default.jpg' ? $arr[0] = '/upload/'.$path.'/'.$avatarName : $arr[0] = '';
        if (in_array('banner', array_keys($object->attributes))){
            $bannerName = $modelClass::find()->where(['id' => $id])->one()['banner'];
            $bannerName ? $arr[1] = '/upload/banners/'.$bannerName : $arr[1] = '';
        }
        return $arr;
    }

    public static function createUploadDirectories($path, $arr = []){
        if (!is_dir('upload/'.$path)){
            foreach ($arr as $value){
                FileHelper::createDirectory('upload/'.$path.'/'.$value);
            }
            foreach (glob('upload/'.$path.'/*') as $item){
                copy('image/default.jpg', $item.'/default.jpg');
            }
        }
        return false;
    }

    public static function myResizeImage($path, $name, $width = [], $height = null, $quality = 80){
        foreach ($width as $value){
            Image::thumbnail('upload/'.$path.'/original/'.$name, $value, $height)
                ->save('upload/'.$path.'/'.$value.'/'.$name, ['quality' => $quality]);
        }
    }

    public static function unlinkImages($path, $arr = []){

        foreach ($arr as $item){
            if (file_exists('upload/'.$path.'/'.$item.'/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                $_SESSION['img_name'] !== 'default.jpg'){
                unlink('upload/'.$path.'/'.$item.'/'.$_SESSION['img_name']);
            }
        }

    }
}
