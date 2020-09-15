<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property GenrePerformance[] $genrePerformances
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[GenrePerformances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenrePerformances()
    {
        return $this->hasMany(GenrePerformance::className(), ['genre_id' => 'id']);
    }
}
