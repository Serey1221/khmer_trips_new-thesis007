<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m230531_040025_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'select_date' => $this->date(),
            'total_guest' => $this->integer(),
            'price' => $this->decimal(10, 2)->defaultValue(0),
            'total_price' => $this->decimal(10, 2)->defaultValue(0),
            'created_by' => $this->integer(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart}}');
    }
}
