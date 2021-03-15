<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%performances}}`.
 */
class m210315_084504_add_mobile_banner_column_to_performances_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('performance', 'mobile_banner', $this->string()->after('banner'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
