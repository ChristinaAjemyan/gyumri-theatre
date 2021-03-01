<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "performance".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $img_path
 * @property string|null $show_date
 * @property string|null $trailer
 * @property int|null $age_restriction
 * @property int|null $performance_length
 * @property string|null $banner
 * @property string|null $author
 * @property int|null $hall
 * @property string|null $short_desc
 * @property string|null $desc
 * @property int|null $is_new
 * @property int|null $slug
 */
class Performance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $avatar_image;
    public $banner_image;

    public static function tableName()
    {
        return 'performance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            ['slug', 'unique'],
            [['show_date'], 'safe'],
            [['desc', 'short_desc'], 'string'],
            [['avatar_image', 'banner_image'], 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
            [['age_restriction', 'performance_length', 'hall', 'is_new'], 'integer'],
            ['age_restriction', 'integer', 'min' => 0],
            ['performance_length', 'integer', 'min' => 1],
            [['title', 'img_path', 'trailer', 'banner', 'author'], 'string', 'max' => 255],
            [['title', 'author'], 'filter', 'filter' => 'mb_strtolower']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            //'img_path' => 'Image',
            'show_date' => 'Show Date',
            'trailer' => 'Trailer',
            'age_restriction' => 'Age Restriction',
            'performance_length' => 'Performance Length',
            'banner' => 'Banner',
            'author' => 'Author',
            'hall' => 'Hall',
            'short_desc' => 'Short Description',
            'desc' => 'Description',
            'is_new' => 'Is New',
            'slug' => 'Slug',
        ];
    }

    public static function getFullName()
    {
        $key = [];
        $fist_name = ArrayHelper::map(Staff::find()->all(), 'id', 'first_name');
        $last_name = ArrayHelper::map(Staff::find()->all(), 'id', 'last_name');
        foreach ($fist_name as $k => $v){
            $key[] = $k;
        }
        $val = array_map(function($v1, $v2){
            $result = Main::uppercaseNames($v1).' '.Main::uppercaseNames($v2);
            return $result;
        }, $fist_name, $last_name);
        return array_combine($key, $val);
    }

    public static function getPerformanceTime($date){
        $monthsAM = ['Հունվար', 'Փետրվար', 'Մարտ', 'Ապրիլ', 'Մայիս', 'Հունիս',
            'Հուլիս', 'Օգոստոս', 'Սեպտեմբեր', 'Հոկտեմբեր', 'Նոյեմբեր', 'Դեկտեմբեր'];
        $monthsRU = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль',
            'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $monthsEN = ['January', 'February', 'March', 'April', 'May', 'June', 'July ',
            'August', 'September', 'October', 'November', 'December',];
        $month = date("m",strtotime($date));
        $cookieLanguage = Yii::$app->request->cookies->getValue('language');
        if ($cookieLanguage == 'en'){
            return date("d",strtotime($date)) .' '. $monthsEN[(int)$month-1] .' '. date("H:i",strtotime($date));
        }
        if ($cookieLanguage == 'ru'){
            return date("d",strtotime($date)) .' '. $monthsRU[(int)$month-1] .' '. date("H:i",strtotime($date));
        }
        return date("d",strtotime($date)) .' '. $monthsAM[(int)$month-1] .' '. date("H:i",strtotime($date));
    }
    public function getType()
    {
        return $this->hasMany(Performance::className(), ['id' => 'type_id']);
    }
}

