<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking_payment}}`.
 */
class m230605_071902_create_booking_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_payment}}', [
            'id' => $this->primaryKey(),
            'booking_id' => $this->integer(),
            'amount' => $this->decimal(10, 2)->defaultValue(0),
            'date' => $this->date(),
            'method_id' => $this->integer(),
            'remark' => $this->string(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking_payment}}');
    }
}
