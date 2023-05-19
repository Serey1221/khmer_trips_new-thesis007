<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_itinerary}}`.
 */
class m230519_083054_create_product_itinerary_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_itinerary}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'city_id' => $this->integer(),
            'title' => $this->string(100),
            'title_kh' => $this->string(100),
            'description' => $this->text(),
            'description_kh' => $this->text(),
            'is_lunch' => $this->integer(),
            'is_dinner' => $this->integer(),
            'is_overnight' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_itinerary}}');
    }
}
