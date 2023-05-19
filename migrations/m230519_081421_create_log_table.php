<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m230519_081421_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(),
            'item_id' => $this->integer(),
            'action' => $this->string(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->text(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
