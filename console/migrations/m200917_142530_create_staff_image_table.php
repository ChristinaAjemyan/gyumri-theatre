<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff_image}}`.
 */
class m200917_142530_create_staff_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff_image}}', [
            'id' => $this->primaryKey(),
            'staff_id' => $this->integer(),
            'image' => $this->string()
        ]);
        $this->createIndex(
            'idx-staff_image-staff_id',
            'staff_image',
            'staff_id'
        );
        $this->addForeignKey(
            'idx-staff_image-staff_id',
            'staff_image',
            'staff_id',
            'staff',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%staff_image}}');
    }
}
