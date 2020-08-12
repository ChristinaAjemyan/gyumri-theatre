<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property integer $default
 * @property string $status
 */
class Languages extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'local', 'name','status'], 'required'],
            [['default'], 'integer'],
            [['status'], 'integer'],
            [['status'], 'in', 'range'=>[0, 1]],
            [['url', 'local'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => Yii::t('label', 'Url'),
            'local' => Yii::t('label', 'Local'),
            'name' => Yii::t('label', 'Name'),
            'default' =>Yii::t('label', 'Is Default'),
            'status' => Yii::t('label', 'Status'),
        ];
    }

    public static function getLangNameByUrl($url)
    {
        $language = Languages::find()->where('url = :url', [':url' => $url])->one();
        return $language->name;
    }

    //Variable for set current language
    static $current = null;

//get current language object
    static function getCurrent()
    {

        $session = Yii::$app->session;
        self::$current=$session->get('language')?$session->get('language'):self::getDefaultLang();


//        if( self::$current === null ){
//            self::$current = self::getDefaultLang();
//        }

        return self::$current;
    }

//set current lang and locale
    static function setCurrent($url = null)
    {

        $session = Yii::$app->session;
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ?  ($session->get('language')?$session->get('language'):self::getDefaultLang()) : $language;
        Yii::$app->language = self::$current->local;
        $session['language']=self::$current;
    }

//get default language
    static function getDefaultLang()
    {
        return Languages::find()->where('`default` = :default', [':default' => 1])->one();
    }
    static function getUserDefaultLangByUrl($url)
    {
        return Languages::find()->where('`url` = :url', [':url' =>$url ])->one();
    }



//get language alpha name
    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Languages::find()->where('url = :url', [':url' => $url])->one();
            if ( $language === null ) {
                return null;
            }else{
                return $language;
            }
        }
    }
}
