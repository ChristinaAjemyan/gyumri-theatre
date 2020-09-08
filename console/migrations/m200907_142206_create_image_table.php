<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m200907_142206_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'performance_id' => $this->integer(),
            'image' => $this->string()
        ]);

        $this->createIndex(
            'idx-image-performance_id',
            'image',
            'performance_id'
        );

        $this->addForeignKey(
            'idx-image-performance_id',
            'image',
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
        $this->dropTable('{{%image}}');
    }
}
