<?php

use yii\db\Migration;

/**
 * Class m190924_204755_update_user_table
 */
class m190924_204755_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `user` DROP INDEX `username`; ";
        $this->execute($sql);
        $sql = "ALTER TABLE `user` CHANGE `username` `username` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;";

        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190924_204755_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190924_204755_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
