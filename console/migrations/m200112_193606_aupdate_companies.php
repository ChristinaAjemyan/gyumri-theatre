<?php

use yii\db\Migration;

/**
 * Class m200112_193606_aupdate_companies
 */
class m200112_193606_aupdate_companies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $sql = "ALTER TABLE `companies` ADD `trial` ENUM('yes','no') NOT NULL DEFAULT 'yes' AFTER `logo`;";
       $sql .= " ALTER TABLE `companies` ADD `status` ENUM('active','expired','pending','rejected') NOT NULL DEFAULT 'pending' AFTER `logo`;";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200112_193606_aupdate_companies cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200112_193606_aupdate_companies cannot be reverted.\n";

        return false;
    }
    */
}
