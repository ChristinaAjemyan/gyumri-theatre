<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre_performance}}`.
 */
class m200907_153002_create_genre_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genre_performance}}', [
            'id' => $this->primaryKey(),
            'genre_id' => $this->integer(),
            'performance_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-genre_performance-genre_id',
            'genre_performance',
            'genre_id'
        );

        $this->addForeignKey(
            'idx-genre_performance-genre_id',
            'genre_performance',
            'genre_id',
            'genre',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-genre_performance-performance_id',
            'genre_performance',
            'performance_id'
        );

        $this->addForeignKey(
            'idx-genre_performance-performance_id',
            'genre_performance',
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
        $this->dropTable('{{%genre_performance}}');
    }
}
