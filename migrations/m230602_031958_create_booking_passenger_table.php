<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking_passenger}}`.
 */
class m230602_031958_create_booking_passenger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_passenger}}', [
            'id' => $this->primaryKey(),
            'is_lead' => $this->tinyInteger(1)->defaultValue(1),
            'booking_id' => $this->integer(),
            'first_name' => $this->string(50),
            'last_name' => $this->string(50),
            'phone_number' => $this->string(20),
            'email' => $this->string(50),
            'age' => $this->integer(2)->defaultValue(18),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking_passenger}}');
    }
}
