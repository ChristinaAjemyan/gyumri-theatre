<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%archive_performance}}`.
 */
class m201203_111314_create_archive_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%archive_performance}}', [
            'id' => $this->primaryKey(),
            'archive_id' => $this->integer(),
            'performance_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-archive_performance-archive_id',
            'archive_performance',
            'archive_id'
        );

        $this->addForeignKey(
            'idx-archive_performance-archive_id',
            'archive_performance',
            'archive_id',
            'archive',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-archive_performance-performance_id',
            'archive_performance',
            'performance_id'
        );

        $this->addForeignKey(
            'idx-archive_performance-performance_id',
            'archive_performance',
            'performance_id',
            'performance',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%archive_performance}}');
    }
}
