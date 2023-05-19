<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_role_permission}}`.
 */
class m230519_084536_create_user_role_permission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_role_permission}}', [
            'id' => $this->primaryKey(),
            'user_role_id' => $this->integer(),
            'action_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_role_permission}}');
    }
}
