<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_performance}}`.
 */
class m201222_090447_create_type_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_performance}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(),
            'performance_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-type_performance-type_id',
            'type_performance',
            'type_id'
        );

        $this->addForeignKey(
            'idx-type_performance-type_id',
            'type_performance',
            'type_id',
            'type',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-type_performance-performance_id',
            'type_performance',
            'performance_id'
        );

        $this->addForeignKey(
            'idx-type_performance-performance_id',
            'type_performance',
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
        $this->dropTable('{{%type_performance}}');
    }
}
