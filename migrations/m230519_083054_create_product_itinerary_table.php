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

        // // add foreign key for table `product`
        // $this->addForeignKey(
        //     '{{%fk-product_itinerary-product_id}}',
        //     '{{%product_itinerary}}',
        //     'product_id',
        //     '{{%product}}',
        //     'id',
        //     'CASCADE'
        // );

        // // add foreign key for table `city`
        // $this->addForeignKey(
        //     '{{%fk-product_itinerary-city_id}}',
        //     '{{%product_itinerary}}',
        //     'city_id',
        //     '{{%city}}',
        //     'id',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // // drops foreign key for table `product`
        // $this->dropForeignKey(
        //     '{{%fk-product_itinerary-product_id}}',
        //     '{{%product_itinerary}}'
        // );

        // // drops foreign key for table `city`
        // $this->dropForeignKey(
        //     '{{%fk-product_itinerary-city_id}}',
        //     '{{%product_itinerary}}'
        // );

        $this->dropTable('{{%product_itinerary}}');
    }
}
