<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_videos}}`.
 */
class m210423_055530_create_project_videos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_videos}}', [
            'id' => $this->primaryKey(),
            'project_id'=>$this->integer(),
            'video_url'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_videos}}');
    }
}
