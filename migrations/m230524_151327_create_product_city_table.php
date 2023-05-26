<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_city}}`.
 */
class m230524_151327_create_product_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_city}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_city}}');
    }
}
