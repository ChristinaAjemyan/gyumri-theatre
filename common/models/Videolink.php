<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "videolink".
 *
 * @property int $id
 * @property int|null $performance_id
 * @property string|null $link
 *
 * @property Performance $performance
 */
class Videolink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videolink';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['performance_id'], 'integer'],
            [['link'], 'string', 'max' => 255],
            [['performance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Performance::className(), 'targetAttribute' => ['performance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'performance_id' => 'Performance ID',
            'link' => 'Link',
        ];
    }

    /**
     * Gets query for [[Performance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformance()
    {
        return $this->hasOne(Performance::className(), ['id' => 'performance_id']);
    }
}
