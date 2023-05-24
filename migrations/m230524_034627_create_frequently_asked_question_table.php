<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%frequently_asked_question}}`.
 */
class m230524_034627_create_frequently_asked_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%frequently_asked_question}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'subject' => $this->string(),
            'description' => $this->string(),
            'status' => $this->tinyInteger(1),
            'created_date' => $this->datetime(),
            'created_by' => $this->integer(),
            'updated_date' => $this->datetime(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%frequently_asked_question}}');
    }
}
