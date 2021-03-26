<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $videolink
 * @property string|null $content
 * @property string|null $img_path
 * @property string|null $dt_create
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $avatar_image;

    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['dt_create','videolink','title', 'content'], 'safe'],
            ['avatar_image', 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
            [['title', 'img_path'], 'string', 'max' => 255],
            ['title', 'filter', 'filter' => 'mb_strtolower']
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
            'content' => 'Content',
            'videolink' => 'Video Link',
            //'img_path' => 'Img Path'
        ];
    }
}
