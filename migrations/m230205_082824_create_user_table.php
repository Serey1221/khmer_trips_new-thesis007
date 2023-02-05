<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230205_082824_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(50),
            'auth_key' => $this->string(50),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string(),
            'email' => $this->string(50),
            'status' => $this->tinyInteger(1),
            'role_id' => $this->integer(2),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
        ]);

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('admin123'),
            'email' => 'admin@khmertravel.com',
            'status' => 1,
            'role_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'created_by' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
