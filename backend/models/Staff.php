<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $date_of_birth
 * @property string|null $img_path
 * @property string|null $country
 * @property string|null $city
 * @property string|null $desc
 * @property string|null $role
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $avatar_image;

    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['date_of_birth'], 'safe'],
            ['avatar_image', 'file', 'extensions' => ['png', 'jpg', 'jpeg']],
            [['desc'], 'string'],
            [['first_name', 'last_name', 'img_path', 'country', 'city', 'role'], 'string', 'max' => 255],
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
            'date_of_birth' => 'Date of birthday',
            'img_path' => 'Img Path',
            'country' => 'Country',
            'city' => 'City',
            'desc' => 'Desc',
            'role' => 'Role',
        ];
    }
}
