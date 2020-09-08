<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff_performance}}`.
 */
class m200908_145445_create_staff_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff_performance}}', [
            'id' => $this->primaryKey(),
            'staff_id' => $this->integer(),
            'performance_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-staff_performance-actor_id',
            'staff_performance',
            'staff_id'
        );

        $this->addForeignKey(
            'idx-staff_performance-staff_id',
            'staff_performance',
            'staff_id',
            'staff',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-staff_performance-performance_id',
            'staff_performance',
            'performance_id'
        );

        $this->addForeignKey(
            'idx-staff_performance-performance_id',
            'staff_performance',
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
        $this->dropTable('{{%staff_performance}}');
    }
}
