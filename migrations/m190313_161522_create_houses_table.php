<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%houses}}`.
 */
class m190313_161522_create_houses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%houses}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'building_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%houses}}');
    }
}
