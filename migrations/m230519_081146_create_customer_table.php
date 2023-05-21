<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m230519_081146_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(100),
            'gender' => $this->string(100),
            'date_of_birth' => $this->dateTime(),
            'address' => $this->string(),
            'phone_number' => $this->integer(),
            'email' => $this->string(),
        ]);

        // // add foreign key for table `user`
        // $this->addForeignKey(
        //     'fk-customer-user_id',
        //     'customer',
        //     'user_id',
        //     'user',
        //     'id',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // // drops foreign key for table `user`
        // $this->dropForeignKey(
        //     'fk-customer-user_id',
        //     'customer'
        // );

        $this->dropTable('{{%customer}}');
    }
}
