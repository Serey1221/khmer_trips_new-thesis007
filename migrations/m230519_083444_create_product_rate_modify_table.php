<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_rate_modify}}`.
 */
class m230519_083444_create_product_rate_modify_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_rate_modify}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'amount' => $this->decimal(),
            'amount_type' => $this->integer(),
            'from_date' => $this->date(),
            'to_date' => $this->date(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->text(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->text(),

        ]);

        // // add foreign key for table `product`
        // $this->addForeignKey(
        //     'fk-product_rate_modify-product_id',
        //     'product_rate_modify',
        //     'product_id',
        //     'product',
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
        //     'fk-product_rate_modify-product_id',
        //     'product_rate_modify'
        // );

        $this->dropTable('{{%product_rate_modify}}');
    }
}
