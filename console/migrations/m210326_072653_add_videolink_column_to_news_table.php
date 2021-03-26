<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%news}}`.
 */
class m210326_072653_add_videolink_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'videolink', $this->string()->after('title'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
