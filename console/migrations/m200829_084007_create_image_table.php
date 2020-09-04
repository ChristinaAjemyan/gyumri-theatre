<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m200829_084007_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'presentation_id' => $this->integer(),
            'image' => $this->string()
        ]);

        $this->createIndex(
            'idx-image-presentation_id',
            'image',
            'presentation_id'
        );

        $this->addForeignKey(
            'idx-image-presentation_id',
            'image',
            'presentation_id',
            'presentation',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
