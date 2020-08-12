<?php
/**
 * Created by PhpStorm.
 * User: Sedrak Sargsyan
 * Date: 10/27/2017
 * Time: 1:37 PM
 */

namespace common\components;


use common\models\Message;
use common\models\SourceMessage;
use Yii;

class TranslationEventHandler
{
    public static function handleMissingTranslation($args)
    {

        //language
        $session=Yii::$app->session;
        $language=$session->has('language')?$session->get('language')->url:'en';
        $category=$args->category;
        $message=$args->message;

        $sourceMessage=SourceMessage::find()
        ->where("BINARY [[category]]=:category AND BINARY [[message]]=:message", ['category'=>$category,'message'=>$message])->one();
        //create source
        if(!$sourceMessage){
           $sourceMessage=new SourceMessage();
           $sourceMessage->category=$category;
           $sourceMessage->message=$message;
           $sourceMessage->save(false);
        }

        //create translation for current language
        $findTranlation=Yii::$app->translate->translate('en', $language, $message);
        if ($findTranlation['code']=='200'){
            $tranlation=$findTranlation['text'][0];
        }else{
            $tranlation=$message;
        }
        $checkMessageExists=Message::find()->where(['language'=>$language,'id'=>$sourceMessage->id])->exists();
        if(!$checkMessageExists){
            $message = new Message();
            $message->id= $sourceMessage->id;
            $message->translation = $tranlation;
            $message->language = $language;
            $message->save();
        }

    }
}