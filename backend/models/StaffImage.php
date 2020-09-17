<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_image".
 *
 * @property int $id
 * @property int|null $staff_id
 * @property string|null $image
 *
 * @property Staff $staff
 */
class StaffImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_id'], 'integer'],
            [['image'], 'string', 'max' => 255],
            ['image', 'file', 'maxFiles' => 10, 'extensions' => ['png', 'jpg', 'jpeg']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staff_id' => 'Staff ID',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }
}
