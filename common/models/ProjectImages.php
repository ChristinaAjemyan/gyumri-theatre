<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_images".
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $photo
 *
 * @property Project $project
 */
class ProjectImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $image;

    public static function tableName()
    {
        return 'project_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'photo' => 'Photo',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
