<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190925_180247_add_companies_table
 */
class m190925_180247_add_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'CREATE TABLE `companies` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `type` ENUM(\'shop\',\'service\',\'all\',\'new\') NOT NULL  , `created_at` VARCHAR(255) NULL , `updated_at` VARCHAR(255) NULL , `logo` VARCHAR(255) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190925_180247_add_companies_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190925_180247_add_companies_table cannot be reverted.\n";

        return false;
    }
    */
}
