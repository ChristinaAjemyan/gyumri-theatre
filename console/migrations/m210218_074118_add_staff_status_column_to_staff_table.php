<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%stuff}}`.
 */
class m210218_074118_add_staff_status_column_to_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('staff', 'staff_status', $this->integer()->after('role_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
