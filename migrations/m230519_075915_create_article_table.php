<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m230519_075915_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'img_url' => $this->string(),
            'slug' => $this->string(),
            'title' => $this->string(),
            'like_user' => $this->string(),
            'unlike_user' => $this->string(),
            'short_description' => $this->string(),
            'description' => $this->text(),
            'status' => $this->tinyInteger(1),
            'viewer' => $this->string(),
            'created_by' => $this->integer(),
            'created_date' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'updated_date' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
