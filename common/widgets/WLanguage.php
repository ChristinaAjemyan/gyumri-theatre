<?php
namespace common\widgets;


use common\models\Languages;

class WLanguage extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {

        return $this->render('language/view', [
            'current' => Languages::getCurrent(),
            'langs' => Languages::find()->where('id != :current_id AND status=1', [':current_id' => Languages::getCurrent()->id])->all(),
        ]);
    }
}