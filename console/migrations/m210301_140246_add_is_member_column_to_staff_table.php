<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%staff}}`.
 */
class m210301_140246_add_is_member_column_to_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('staff', 'is_member', $this->boolean()->after('slug'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
