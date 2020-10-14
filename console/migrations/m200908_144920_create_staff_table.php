<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%staff}}`.
 */
class m200908_144920_create_staff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%staff}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'date_of_birth' => $this->date(),
            'img_path' => $this->string(),
            'country' => $this->string(),
            'city' => $this->string(),
            'inst_url' => $this->string(),
            'staff_genre_type' => $this->string(),
            'desc' => $this->text(),
            'role_id' => $this->integer(),
            'slug' => $this->string()->notNull()->unique()
        ]);

        $this->createIndex(
            'idx-staff-role_id',
            'staff',
            'role_id'
        );

        $this->addForeignKey(
            'idx-staff-role_id',
            'staff',
            'role_id',
            'role',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%staff}}');
    }
}
