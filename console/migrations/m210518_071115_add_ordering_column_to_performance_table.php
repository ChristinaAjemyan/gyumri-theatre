<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%performance}}`.
 */
class m210518_071115_add_ordering_column_to_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('performance','ordering',$this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
