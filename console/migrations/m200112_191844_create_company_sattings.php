<?php

use yii\db\Migration;

/**
 * Class m200112_191844_create_company_sattings
 */
class m200112_191844_create_company_sattings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $sql ="
      CREATE TABLE `company_settings` ( 
      `id` INT NOT NULL AUTO_INCREMENT , 
      `company_id` INT(11) NOT NULL , 
      `phone` INT NOT NULL , 
      `email` VARCHAR(255) NOT NULL , 
     
       `address` TEXT NOT NULL ,
        `country` VARCHAR(255) NOT NULL , 
        `city` VARCHAR(255) NOT NULL , `zip` VARCHAR(255) NOT NULL , 
      PRIMARY KEY (`id`)
     
      ) ENGINE = InnoDB;
      ALTER TABLE `company_settings`
  ADD CONSTRAINT `company_id_company_settings` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
              

      ";
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200112_191844_create_company_sattings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200112_191844_create_company_sattings cannot be reverted.\n";

        return false;
    }
    */
}
