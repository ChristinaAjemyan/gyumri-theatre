<?php

namespace app\models;

use Yii;

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

    public $file;

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
            //['title', 'required'],
            [['show_date', 'actors_id'], 'safe'],
            [['desc'], 'string'],
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
            'img_path' => 'Img Path',
            'actors_id' => 'Select Actors',
            'show_date' => 'Show Date',
            'trailer' => 'Trailer',
            'desc' => 'Desc',
            'is_new' => 'Is New',
        ];
    }
}
