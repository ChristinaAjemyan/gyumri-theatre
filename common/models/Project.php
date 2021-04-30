<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $img
 * @property string|null $banner
 * @property string|null $description
 * @property string|null $video_link
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $avatar_image;
    public $banner_image;
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'],'required'],
            [['img_path','banner'],'file','skipOnEmpty' => true,],
            [['title', 'banner', 'video_link'], 'string', 'max' => 255],
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
            'img' => 'Image',
            'banner' => 'Banner',
            'description' => 'Description',
            'video_link' => 'Video Link',
        ];
    }
}
