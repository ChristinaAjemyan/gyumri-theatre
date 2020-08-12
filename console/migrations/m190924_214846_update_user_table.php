<?php

use yii\db\Migration;

/**
 * Class m190924_214846_update_user_table
 */
class m190924_214846_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "ALTER TABLE `user` CHANGE `username` `first_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;";
        $this->execute($sql);
        $sql = "ALTER TABLE `user` ADD `last_name` VARCHAR(255) NULL AFTER `first_name`, ADD `phone` VARCHAR(255) NOT NULL AFTER `last_name`, ADD `lang` VARCHAR(10) NOT NULL AFTER `phone`, ADD `company_id` INT(11) NOT NULL AFTER `lang`;  ";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190924_214846_update_user_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190924_214846_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
