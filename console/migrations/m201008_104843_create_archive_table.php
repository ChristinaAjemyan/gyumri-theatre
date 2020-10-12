<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%archive}}`.
 */
class m201008_104843_create_archive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%archive}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'img_path' => $this->string(),
            'dt_create' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%archive}}');
    }
}
