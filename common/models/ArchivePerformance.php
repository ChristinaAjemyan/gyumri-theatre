<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "archive_performance".
 *
 * @property int $id
 * @property int|null $archive_id
 * @property int|null $performance_id
 *
 * @property Archive $archive
 * @property Performance $performance
 */
class ArchivePerformance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archive_performance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archive_id', 'performance_id'], 'integer'],
            [['archive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archive::className(), 'targetAttribute' => ['archive_id' => 'id']],
            [['performance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Performance::className(), 'targetAttribute' => ['performance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'archive_id' => Yii::t('app', 'Archive ID'),
            'performance_id' => Yii::t('app', 'Performance ID'),
        ];
    }

    /**
     * Gets query for [[Archive]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchive()
    {
        return $this->hasOne(Archive::className(), ['id' => 'archive_id']);
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
