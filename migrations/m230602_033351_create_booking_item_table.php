<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking_item}}`.
 */
class m230602_033351_create_booking_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking_item}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(20),
            'booking_id' => $this->integer(),
            'product_id' => $this->integer(),
            'departure_date' => $this->date(),
            'return_date' => $this->date(),
            'total_guest' => $this->integer(2),
            'price' => $this->decimal(10, 2)->defaultValue(0),
            'total_price' => $this->decimal(10, 2)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booking_item}}');
    }
}
