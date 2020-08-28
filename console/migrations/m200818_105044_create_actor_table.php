<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%actor}}`.
 */
class m200818_105044_create_actor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%actor}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'birthday' => $this->date(),
            'img_path' => $this->string(),
            'country' => $this->string(),
            'city' => $this->string(),
            'desc' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%actor}}');
    }
}
