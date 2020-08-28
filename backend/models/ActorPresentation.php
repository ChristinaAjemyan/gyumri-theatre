<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor_presentation".
 *
 * @property int $id
 * @property int|null $actor_id
 * @property int|null $presentation_id
 *
 * @property Actor $actor
 * @property Presentation $presentation
 */
class ActorPresentation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;

    public static function tableName()
    {
        return 'actor_presentation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['actor_id', 'presentation_id'], 'integer'],
            [['actor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actor::className(), 'targetAttribute' => ['actor_id' => 'id']],
            [['presentation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presentation::className(), 'targetAttribute' => ['presentation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actor_id' => 'Actor ID',
            'presentation_id' => 'Presentation ID',
        ];
    }

    /**
     * Gets query for [[Actor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(Actor::className(), ['id' => 'actor_id']);
    }

    /**
     * Gets query for [[Presentation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresentation()
    {
        return $this->hasOne(Presentation::className(), ['id' => 'presentation_id']);
    }
}
