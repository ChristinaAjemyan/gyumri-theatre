<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project_images}}`.
 */
class m210422_070426_create_project_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%project_images}}', [
            'id' => $this->primaryKey(),
            'project_id'=>$this->integer(),
            'photo'=>$this->string(),
        ]);

        $this->createIndex(
            'idx-post-project_id',
            'project_images',
            'project_id'
        );

        $this->addForeignKey(
            'fk-post-project_id',
            'project_images',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%project_images}}');
    }
}
