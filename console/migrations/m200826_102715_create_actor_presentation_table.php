<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%actor_presentation}}`.
 */
class m200826_102715_create_actor_presentation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%actor_presentation}}', [
            'id' => $this->primaryKey(),
            'actor_id' => $this->integer(),
            'presentation_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-actor_presentation-actor_id',
            'actor_presentation',
            'actor_id'
        );

        $this->addForeignKey(
            'idx-actor_presentation-actor_id',
            'actor_presentation',
            'actor_id',
            'actor',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-actor_presentation-presentation_id',
            'actor_presentation',
            'presentation_id'
        );

        $this->addForeignKey(
            'idx-actor_presentation-presentation_id',
            'actor_presentation',
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
        $this->dropTable('{{%actor_presentation}}');
    }
}
