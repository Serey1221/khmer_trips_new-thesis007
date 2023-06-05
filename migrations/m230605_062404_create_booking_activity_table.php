<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking_activity}}`.
 */
class m230605_062404_create_booking_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_activity}}', [
            'id' => $this->primaryKey(),
            'booking_id' => $this->integer(),
            'payment_id' => $this->integer(),
            'type' => $this->string(20),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking_activity}}');
    }
}
