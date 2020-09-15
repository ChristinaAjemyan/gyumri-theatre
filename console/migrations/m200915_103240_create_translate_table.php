<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translate}}`.
 */
class m200915_103240_create_translate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%translate}}', [
            'id' => $this->primaryKey(),
            'table_name' => $this->string(),
            'column_name' => $this->string(),
            'language' => $this->string(),
            'text' => $this->text(),
            'table_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%translate}}');
    }
}
