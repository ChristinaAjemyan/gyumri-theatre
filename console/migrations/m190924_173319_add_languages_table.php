<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m190924_173319_add_languages_table
 */
class m190924_173319_add_languages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('languages', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING . '(10) NOT NULL',
            'local' => Schema::TYPE_STRING . '(10) NOT NULL',
            'name' => Schema::TYPE_STRING . '(20) NOT NULL',
            'default' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
        ]);
        $this->batchInsert('languages', ['url', 'local', 'name', 'default', 'status'], [
            ['en', 'en-EN', 'English', 1, 1],
            ['hy', 'hy-Hy', 'Armenian', 0, 1],
            ['ru', 'ru-Ru', 'Dutch', 0, 1],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190924_173319_add_languages_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190924_173319_add_languages_table cannot be reverted.\n";

        return false;
    }
    */
}
