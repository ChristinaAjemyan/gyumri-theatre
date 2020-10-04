<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 03.09.2020
 * Time: 16:03
 */

namespace common\models;


use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\imagine\Image;
//use common\models\Image;
use common\models\Translate;


class Main extends Model
{
    public static function getInitialPreview($id, $model, $path){
        $arr = [];
        $modelName = ucfirst($model->tableName());
        $modelClass =  "\common\models\\".$modelName;
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

    public static function unlinkAllImagesById($model, $id, $path, $arrDirName = []){
        $modelName = ucfirst($model->tableName());
        $modelClass =  "\common\models\\".$modelName;
        $fieldById = $modelClass::findOne($id);
        foreach ($arrDirName as $item){
            if (file_exists("upload/$path/$item/$fieldById->img_path")){
                unlink("upload/$path/$item/$fieldById->img_path");
            }
        }
        if ($path == 'galleries'){
            $imagesById = \common\models\Image::find()->where(['performance_id' => $id])->all();
            foreach ($arrDirName as $item){
                foreach ($imagesById as $img){
                    if (file_exists("upload/$path/$item/$img->image")){
                        unlink("upload/$path/$item/$img->image");
                    }
                }
            }
        }
        if ($path == 'banners'){
            if (file_exists("upload/$path/$fieldById->banner")){
                unlink("upload/$path/$fieldById->banner");
            }
        }
    }

    public static function createTranslationUrlRU($id, $table_name, $columnName){
        $modelName = ucfirst($table_name);
        $modelClass =  "\common\models\\".$modelName;
        $str = ''; $translation_id = ''; $count = 0;
        $arrMessageAll = ArrayHelper::map(SourceMessage::find()->all(), 'id', 'message');
        if (!empty($columnName) && isset($columnName)){
            foreach ($columnName as $item){
                $str .= "col[]=$item&";
            }
            $col = trim($str, '&');
            foreach ($columnName as $value){
                if (in_array($modelClass::findOne($id)->$value, $arrMessageAll)){
                    $message_id = SourceMessage::find()->where(['message' => $modelClass::findOne($id)->$value])->all()[0]->id;
                    $hasMessage = Message::find()->where(['id' => $message_id, 'language' => 'ru'])->all()[0];
                    if ($hasMessage !== null){
                        $translation_id .= "tr_id[]=".Message::find()->where(['id' => $message_id, 'language' => 'ru'])->all()[0]->id."&";
                        $tr_id = trim($translation_id, '&');
                        $count = 1;
                    }
                }
            }
        }
        if ($count == 1){
            $urlRU = "/translate/update?id=$id&lang=ru&table_name=$table_name&$col&$tr_id";
        }else{
            $urlRU = "/translate/create?id=$id&lang=ru&table_name=$table_name&$col";
        }
        return $urlRU;
    }

    public static function createTranslationUrlEN($id, $table_name, $columnName){
        $modelName = ucfirst($table_name);
        $modelClass =  "\common\models\\".$modelName;
        $str = ''; $translation_id = ''; $count = 0;
        $arrMessageAll = ArrayHelper::map(SourceMessage::find()->all(), 'id', 'message');
        if (!empty($columnName) && isset($columnName)){
            foreach ($columnName as $item){
                $str .= "col[]=$item&";
            }
            $col = trim($str, '&');
            foreach ($columnName as $value){
                if (in_array($modelClass::findOne($id)->$value, $arrMessageAll)){
                    $message_id = SourceMessage::find()->where(['message' => $modelClass::findOne($id)->$value])->all()[0]->id;
                    $hasMessage = Message::find()->where(['id' => $message_id, 'language' => 'en'])->all()[0];
                    if ($hasMessage !== null){
                        $translation_id .= "tr_id[]=".Message::find()->where(['id' => $message_id, 'language' => 'en'])->all()[0]->id."&";
                        $tr_id = trim($translation_id, '&');
                        $count = 1;
                    }
                }
            }
        }
        if ($count == 1){
            $urlEN = "/translate/update?id=$id&lang=en&table_name=$table_name&$col&$tr_id";
        }else{
            $urlEN = "/translate/create?id=$id&lang=en&table_name=$table_name&$col";
        }
        return $urlEN;
    }


}
