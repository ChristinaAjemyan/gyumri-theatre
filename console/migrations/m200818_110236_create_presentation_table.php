<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%presentation}}`.
 */
class m200818_110236_create_presentation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%presentation}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'img_path' => $this->string(),
            //'actors_id' => $this->string(),
            'show_date' => $this->timestamp(),
            'trailer' => $this->string()->defaultValue('NULL'),
            'desc' => $this->text(),
            'is_new' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%presentation}}');
    }
}
