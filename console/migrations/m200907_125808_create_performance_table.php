<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%performance}}`.
 */
class m200907_125808_create_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%performance}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'img_path' => $this->string(),
            'show_date' => $this->timestamp(),
            'trailer' => $this->string()->defaultValue('NULL'),
            'age_restriction' => $this->integer(),
            'performance_length' => $this->integer(),
            'banner' => $this->string(),
            'author' => $this->string(),
            'hall' => $this->integer(),
            'short_desc' => $this->text(),
            'desc' => $this->text(),
            'is_new' => $this->boolean(),
            'slug' => $this->string()->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%performance}}');
    }
}
