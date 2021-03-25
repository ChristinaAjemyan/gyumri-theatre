<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%videolink}}`.
 */
class m210325_123416_create_videolink_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%videolink}}', [
            'id' => $this->primaryKey(),
            'performance_id' => $this->integer(),
            'link' => $this->string()
        ]);

        $this->createIndex(
            'idx-videolink-performance_id',
            'videolink',
            'performance_id'
        );

        $this->addForeignKey(
            'idx-videolink-performance_id',
            'videolink',
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
        $this->dropTable('{{%videolink}}');
    }
}
