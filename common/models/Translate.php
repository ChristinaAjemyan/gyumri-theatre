<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "translate".
 *
 * @property int $id
 * @property string|null $table_name
 * @property string|null $column_name
 * @property string|null $language
 * @property string|null $text
 * @property int|null $table_id
 */
class Translate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'safe'],
            [['text'], 'required'],
            [['table_id'], 'integer'],
            [['table_name', 'column_name', 'language'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => 'Table Name',
            'column_name' => 'Column Name',
            'language' => 'Language',
            'text' => 'Text',
            'table_id' => 'Table ID',
        ];
    }
}
