<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "presentation".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $img_path
 * @property string|null $actors_id
 * @property string|null $show_date
 * @property string|null $trailer
 * @property string|null $desc
 * @property int|null $is_new
 */
class Presentation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $avatar_image;

    public static function tableName()
    {
        return 'presentation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['show_date'], 'safe'],
            [['desc'], 'string'],
            ['avatar_image', 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
            [['is_new'], 'integer'],
            [['title', 'img_path', 'trailer'], 'string', 'max' => 255],
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
            'desc' => 'Description',
            'is_new' => 'Is New',
        ];
    }

    public static function getFullName()
    {
        $key = [];
        $fist_name = ArrayHelper::map(Actor::find()->all(), 'id', 'first_name');
        $last_name = ArrayHelper::map(Actor::find()->all(), 'id', 'last_name');
        foreach ($fist_name as $k => $v){
            $key[] = $k;
        }
        $val = array_map(function($v1, $v2){
            $result = $v1.' '.$v2;
            return $result;
        }, $fist_name, $last_name);
        return array_combine($key, $val);
    }
}

