<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%archive_image}}`.
 */
class m201203_082427_create_archive_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%archive_image}}', [
            'id' => $this->primaryKey(),
            'archive_id' => $this->integer(),
            'image' => $this->string()
        ]);
        $this->createIndex(
            'idx-archive_image-archive_id',
            'archive_image',
            'archive_id'
        );
        $this->addForeignKey(
            'idx-archive_image-archive_id',
            'archive_image',
            'archive_id',
            'archive',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%archive_image}}');
    }
}
