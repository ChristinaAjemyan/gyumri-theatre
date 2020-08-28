<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $birthday
 * @property string|null $img_path
 * @property string|null $country
 * @property string|null $city
 * @property string|null $desc
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;

    public static function tableName()
    {
        return 'actor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['birthday'], 'safe'],
            [['desc'], 'string'],
            [['first_name', 'last_name', 'img_path', 'country', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthday' => 'Birthday',
            'img_path' => 'Img Path',
            'country' => 'Country',
            'city' => 'City',
            'desc' => 'Desc',
        ];
    }
}
