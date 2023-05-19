<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m230519_080727_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'name_kh' => $this->string(100),
            'description' => $this->string(250),
            'country_id' => $this->integer(100),
            'img_url' => $this->string(),
            'status' => $this->tinyInteger(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
