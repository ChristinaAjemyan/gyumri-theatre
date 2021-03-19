<?php

use yii\db\Migration;

/**
 * Class m210318_093009_add_external_id_column_to_performance_table
 */
class m210318_093009_add_external_id_column_to_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('performance', 'external_id', $this->integer()->after('slug'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210318_093009_add_external_id_column_to_performance_table cannot be reverted.\n";

        return false;
    }
}
