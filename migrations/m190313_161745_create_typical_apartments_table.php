<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%typical_apartments}}`.
 */
class m190313_161745_create_typical_apartments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%typical_apartments}}', [
            'id' => $this->primaryKey(),
            'rooms' => 'ENUM("студия", "1к", "2к", "3к", "4к", "5к", "5к двухуровневая", "6к двухуровневая")',
            'square' => $this->float(),
            'price_per_square_meter' => $this->float()->defaultValue(null),
            'price' => $this->float()->defaultValue(null),
            'building_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%typical_apartments}}');
    }
}
