<?php

use yii\db\Migration;

/**
 * Class m210219_130258_add_index_description_to_staff_table
 */
class m210219_130258_add_index_description_to_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('staff', 'index_description', $this->text()->after('desc'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210219_130258_add_index_description_to_staff_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210219_130258_add_index_description_to_staff_table cannot be reverted.\n";

        return false;
    }
    */
}
