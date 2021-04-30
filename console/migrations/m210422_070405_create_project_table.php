<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m210422_070405_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'img_path'=>$this->string(),
            'banner'=>$this->string(),
            'description'=>$this->text(),
            'video_link'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}
