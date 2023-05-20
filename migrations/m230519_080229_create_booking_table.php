<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booking}}`.
 */
class m230519_080229_create_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'customer_id' => $this->integer(),
            'from_date' => $this->dateTime(),
            'to_date' => $this->dateTime(),
            'total_amount' => $this->string(100),
            'paid' => $this->decimal(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->text(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->text(),
            'status' => $this->tinyInteger(1),
        ]);

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-booking-product_id',
            'booking',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // add foreign key for table `customer`
        $this->addForeignKey(
            'fk-booking-customer_id',
            'booking',
            'customer_id',
            'customer',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-booking-product_id',
            'booking'
        );

        // drops foreign key for table `customer`
        $this->dropForeignKey(
            'fk-booking-customer_id',
            'booking'
        );
        $this->dropTable('{{%booking}}');
    }
}
