<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_role_group}}`.
 */
class m230519_084425_create_user_role_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_role_group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'sort' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_role_group}}');
    }
}
