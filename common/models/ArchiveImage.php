<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "archive_image".
 *
 * @property int $id
 * @property int|null $archive_id
 * @property string|null $image
 *
 * @property Archive $archive
 */
class ArchiveImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archive_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archive_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            ['image', 'file', 'maxFiles' => 10, 'extensions' => ['png', 'jpg', 'jpeg']],
            [['archive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archive::className(), 'targetAttribute' => ['archive_id' => 'id']],
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
            'image' => Yii::t('app', 'Image'),
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
}
