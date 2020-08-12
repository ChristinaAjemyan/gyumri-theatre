<?php

use yii\db\Migration;

/**
 * Class m200512_055013_add_service_table
 */
class m200512_055013_add_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "
          CREATE TABLE `services` (
          `id` int(11) NOT NULL,
          `name` varchar(255) NOT NULL,
          `description` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
        ";
        $this->execute($sql);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200512_055013_add_service_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200512_055013_add_service_table cannot be reverted.\n";

        return false;
    }
    */
}
