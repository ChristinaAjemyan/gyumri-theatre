<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_videos".
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $video_url
 */
class ProjectVideos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id'], 'integer'],
            [['video_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'video_url' => 'Video Url',
        ];
    }
}
