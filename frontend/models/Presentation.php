<?php
/**
 * Created by PhpStorm.
 * User: Student-Gitc
 * Date: 30.08.2020
 * Time: 12:09
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Presentation extends ActiveRecord
{

    public static function tableName()
    {
        return 'presentation';
    }


}
