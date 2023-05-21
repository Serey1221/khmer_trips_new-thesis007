<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_style_data}}`.
 */
class m230519_083905_create_product_style_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_style_data}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'style_id' => $this->integer(),
        ]);

        // // add foreign key for table `product`
        // $this->addForeignKey(
        //     'fk-product_style_data-product_id',
        //     'product_style_data',
        //     'product_id',
        //     'product',
        //     'id',
        //     'CASCADE'
        // );

        // // add foreign key for table `style`
        // $this->addForeignKey(
        //     'fk-product_style_data-style_id',
        //     'product_style_data',
        //     'style_id',
        //     'style',
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
        //     'fk-product_style_data-product_id',
        //     'product_style_data'
        // );

        // // drops foreign key for table `style`
        // $this->dropForeignKey(
        //     'fk-product_style_data-style_id',
        //     'product_style_data'
        // );

        $this->dropTable('{{%product_style_data}}');
    }
}
