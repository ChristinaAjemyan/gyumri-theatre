<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_performance".
 *
 * @property int $id
 * @property int|null $staff_id
 * @property int|null $performance_id
 *
 * @property Staff $staff
 * @property Performance $performance
 */
class StaffPerformance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_performance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_id'], 'required'],
            [['staff_id', 'performance_id'], 'integer'],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff_id' => 'id']],
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
            'staff_id' => 'Select Staff',
            'performance_id' => 'Performance ID',
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
