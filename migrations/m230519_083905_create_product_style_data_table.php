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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_style_data}}');
    }
}
