<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%archive}}`.
 */
class m201204_072632_add_active_season_column_to_archive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%archive}}', 'active_season', $this->boolean()->after('img_path')->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
