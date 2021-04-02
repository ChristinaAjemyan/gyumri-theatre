<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%performance}}`.
 */
class m210402_113601_add_tour_link_column_to_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('performance', 'tour_link', $this->string()->after('hall'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
