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

        // add foreign key for table `user_role`
        $this->addForeignKey(
            'fk-user_role_permission-user_role_id',
            'user_role_permission',
            'user_role_id',
            'user_role',
            'id',
            'CASCADE'
        );

        // add foreign key for table `user_role_action`
        $this->addForeignKey(
            'fk-user_role_permission-user_action_id',
            'user_role_permission',
            'action_id',
            'user_role_action',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-user_role_permission-user_role_id',
            'user_role_permission'
        );

        // drops foreign key for table `user_role_action`
        $this->dropForeignKey(
            'fk-user_role_permission-user_action_id',
            'user_role_permission'
        );

        $this->dropTable('{{%user_role_permission}}');
    }
}
