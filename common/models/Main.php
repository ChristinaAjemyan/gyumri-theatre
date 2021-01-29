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
        if (!is_dir(Yii::getAlias('@backend').'/web/upload/'.$path)){
            foreach ($arr as $value){
                FileHelper::createDirectory(Yii::getAlias('@backend').'/web/upload/'.$path.'/'.$value);
            }
            foreach (glob(Yii::getAlias('@backend').'/web/upload/'.$path.'/*') as $item){
                copy('image/default.jpg', $item.'/default.jpg');
            }
        }
        return false;
    }

    public static function myResizeImage($path, $name, $width = [], $height = null, $quality = 80){
        foreach ($width as $value){
            Image::thumbnail(Yii::getAlias('@backend').'/web/upload/'.$path.'/original/'.$name, $value, $height)
                ->save(Yii::getAlias('@backend').'/web/upload/'.$path.'/'.$value.'/'.$name, ['quality' => $quality]);
        }
    }

    public static function unlinkImages($path, $arr = []){
        foreach ($arr as $item){
            if (file_exists(Yii::getAlias('@backend').'/web/upload/'.$path.'/'.$item.'/'.$_SESSION['img_name']) && $_SESSION['img_name'] !== null &&
                $_SESSION['img_name'] !== 'default.jpg'){
                unlink(Yii::getAlias('@backend').'/web/upload/'.$path.'/'.$item.'/'.$_SESSION['img_name']);
            }
        }
    }

    public static function unlinkAllImagesById($model, $id, $path, $arrDirName = []){
        $modelName = ucfirst($model->tableName());
        $modelClass =  "\common\models\\".$modelName;
        $fieldById = $modelClass::findOne($id);
        foreach ($arrDirName as $item){
            if (file_exists(Yii::getAlias('@backend')."/web/upload/$path/$item/$fieldById->img_path")){
                unlink(Yii::getAlias('@backend')."/web/upload/$path/$item/$fieldById->img_path");
            }
        }
        if ($path == 'galleries'){
            $imagesById = \common\models\Image::find()->where(['performance_id' => $id])->all();
            if (!empty($imagesById)){
                foreach ($arrDirName as $item){
                    foreach ($imagesById as $img){
                        if (file_exists(Yii::getAlias('@backend')."/web/upload/$path/$item/$img->image")){
                            unlink(Yii::getAlias('@backend')."/web/upload/$path/$item/$img->image");
                        }
                    }
                }
            }

        }
        if ($path == 'banners'){
            if ($fieldById->banner !== null &&
                file_exists(Yii::getAlias('@backend')."/web/upload/$path/$fieldById->banner")){
                unlink(Yii::getAlias('@backend')."/web/upload/$path/$fieldById->banner");
            }
        }

    }

    public static function createTranslationUrlRU($id, $table_name, $columnName){
        $modelName = ucfirst($table_name);
        $modelClass =  "\common\models\\".$modelName;
        $str = ''; $translation_id = ''; $count = 0; $i = 0;
        $arrSourceMessageAll = ArrayHelper::map(SourceMessage::find()->all(), 'id', 'message');
        if (!empty($columnName) && isset($columnName)){
            foreach ($columnName as $item){
                $str .= "col[]=$item&";
            }
            $col = trim($str, '&');
            foreach ($columnName as $value){
                if (in_array($modelClass::findOne($id)->$value, $arrSourceMessageAll)){
                    $message_id = SourceMessage::find()->where(['message' => $modelClass::findOne($id)->$value])->all()[0]->id;
                    $hasMessage = Message::find()->where(['id' => $message_id, 'language' => 'ru'])->all()[0];
                    if ($hasMessage !== null){
                        $translation_id .= "tr_id[]=".Message::find()->where(['id' => $message_id, 'language' => 'ru'])->all()[0]->id."&";
                        $count = 1;
                    }else{
                        $i = 1;
                    }
                }else{
                    $i = 1;
                }
            }
        }
        $tr_id = trim($translation_id, '&');
        if ($count == 1 && $i !== 1){
            $urlRU = "/translate/update?id=$id&lang=ru&table_name=$table_name&$col&$tr_id";
        }else{
            $urlRU = "/translate/create?id=$id&lang=ru&table_name=$table_name&$col";
        }
        return $urlRU;
    }

    public static function createTranslationUrlEN($id, $table_name, $columnName){
        $modelName = ucfirst($table_name);
        $modelClass =  "\common\models\\".$modelName;
        $str = ''; $translation_id = ''; $count = 0; $i = 0;
        $arrSourceMessageAll = ArrayHelper::map(SourceMessage::find()->all(), 'id', 'message');
        if (!empty($columnName) && isset($columnName)){
            foreach ($columnName as $item){
                $str .= "col[]=$item&";
            }
            $col = trim($str, '&');
            foreach ($columnName as $value){
                if (in_array($modelClass::findOne($id)->$value, $arrSourceMessageAll)){
                    $message_id = SourceMessage::find()->where(['message' => $modelClass::findOne($id)->$value])->all()[0]->id;
                    $hasMessage = Message::find()->where(['id' => $message_id, 'language' => 'en'])->all()[0];
                    if ($hasMessage !== null){
                        $translation_id .= "tr_id[]=".Message::find()->where(['id' => $message_id, 'language' => 'en'])->all()[0]->id."&";
                        $count = 1;
                    }else{
                        $i = 1;
                    }
                }else{
                    $i = 1;
                }
            }
        }
        $tr_id = trim($translation_id, '&');
        if ($count == 1 && $i !== 1){
            $urlEN = "/translate/update?id=$id&lang=en&table_name=$table_name&$col&$tr_id";
        }else{
            $urlEN = "/translate/create?id=$id&lang=en&table_name=$table_name&$col";
        }
        return $urlEN;
    }

    public static function uppercaseFirstLetter($str){
        return mb_substr(mb_strtoupper(Yii::t('text', $str)), 0, 1).mb_substr(Yii::t('text', $str), 1);
    }
    public static function uppercaseNames($str){
        return  mb_convert_case(Yii::t('text', $str), MB_CASE_TITLE, "UTF-8");
    }


}
