<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%archive_performance}}`.
 */
class m210520_074716_add_ordering_column_to_archive_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('archive_performance','ordering',$this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
