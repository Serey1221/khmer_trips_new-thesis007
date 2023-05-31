<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_wishlist}}`.
 */
class m230530_133000_create_user_wishlist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_wishlist}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_wishlist}}');
    }
}
