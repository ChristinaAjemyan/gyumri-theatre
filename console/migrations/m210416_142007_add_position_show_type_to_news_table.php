<?php

use yii\db\Migration;

/**
 * Class m210416_142007_add_position_show_type_to_news_table
 */
class m210416_142007_add_position_show_type_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'show_type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210416_142007_add_position_show_type_to_news_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210416_142007_add_position_show_type_to_news_table cannot be reverted.\n";

        return false;
    }
    */
}
