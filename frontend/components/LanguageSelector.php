<?php

namespace frontend\components;

use Yii;
use yii\base\BootstrapInterface;


class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = ['am', 'ru', 'en'];

    public function bootstrap($app)
    {
        $cookieLanguage = Yii::$app->request->cookies->getValue('language');
        if (isset($cookieLanguage) && in_array($cookieLanguage, $this->supportedLanguages)){
            $app->language = Yii::$app->request->cookies->getValue('language');
        }
    }
}
