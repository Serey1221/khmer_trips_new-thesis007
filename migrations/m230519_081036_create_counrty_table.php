<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%counrty}}`.
 */
class m230519_081036_create_counrty_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%counrty}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'description' => $this->string(250),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%counrty}}');
    }
}
