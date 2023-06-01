<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_gallery}}`.
 */
class m230601_065310_create_product_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_gallery}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'img_url' => $this->string(),
            'title' => $this->string(50),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_gallery}}');
    }
}
