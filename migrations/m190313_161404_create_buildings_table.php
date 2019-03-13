<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%buildings}}`.
 */
class m190313_161404_create_buildings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%buildings}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'city' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%buildings}}');
    }
}
