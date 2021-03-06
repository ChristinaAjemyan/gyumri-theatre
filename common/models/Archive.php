<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "archive".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $img_path
 * @property string|null $dt_create
 */
class Archive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'archive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['dt_create','active_season'], 'safe'],
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
            //'img_path' => 'Img Path',
        ];
    }
}
