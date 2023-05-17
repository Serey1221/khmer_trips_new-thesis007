<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%guide_profile}}`.
 */
class m230517_140537_create_guide_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guide_profile}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'language' => $this->string(20),
            'img_url' => $this->string(),
            'status' => $this->tinyInteger(1)->defaultValue(1),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%guide_profile}}');
    }
}
