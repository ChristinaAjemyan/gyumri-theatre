<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%staff}}`.
 */
class m210219_092304_add_primary_key_column_to_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('staff', 'primary_key', $this->boolean()->after('staff_status'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
