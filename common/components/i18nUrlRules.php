<?php
namespace common\components;

use Yii;
use yii\base\BootstrapInterface;

class i18nUrlRules implements BootstrapInterface
{
    public static $i18nRules=[
        'quick-search/index' => [
            'de' => 'schnell-suchen',
            'fr' => 'recherche-rapide',
            'en' => 'quick-search',
            'nl' => 'snel-zoeken',
            'ru'=>'быстрый-поиск',
            'es'=>'busqueda-rapida',
        ],
        'quick-search' => [
            'de' => 'schnell-suchen',
            'fr' => 'recherche-rapide',
            'en' => 'quick-search',
            'nl' => 'snel-zoeken',
            'ru'=>'быстрый-поиск',
            'es'=>'busqueda-rapida',
        ],
        'quick-search/save-company-details' => [
            'de' => 'schnell-suchen/daten',
            'fr' => 'recherche-rapide/donnees',
            'en' => 'quick-search/details',
            'nl' => 'snel-zoeken/gegevens',
            'ru'=>'быстрый-поиск/сохранить-компании-подробности',
            'es'=>'busqueda-rapida/datos',
        ],
        'quick-search/confirm' => [
            'de' => 'schnell-suchen/besteatigung',
            'fr' => 'recherche-rapide/confirmation',
            'en' => 'quick-search/confirm',
            'nl' => 'snel-zoeken/bevestiging',
            'ru'=>'быстрый-поиск/подтвердить',
            'es'=>'busqueda-rapida/confirmacion',
        ],
    ];

    public function bootstrap($app)
    {
        //Place here the translated UrlRules
        $languages = ['en','de','fr', 'nl', 'ru', 'es'];
        foreach ($languages as $language){
            Yii::$app->getUrlManager()->addRules(
                [
                    self::$i18nRules['quick-search/index'][$language] =>'quick-search/index',
                    self::$i18nRules['quick-search/save-company-details'][$language] =>'quick-search/index',
                    self::$i18nRules['quick-search/confirm'][$language] =>'quick-search/index',
                    self::$i18nRules['quick-search'][$language] =>'quick-search/index',
                ]);
        }

    }

    public static function findRequestUrl($language, $Url)
    {
        foreach (self::$i18nRules as $rule){
            foreach ($rule as $lang => $item){
                if ($item == $Url){
                    return isset($rule[$language]) ? $rule[$language] : $rule['en'];
                }
            }
        }
        return null;
    }
}