<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_style}}`.
 */
class m230519_083810_create_product_style_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_style}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_style}}');
    }
}
