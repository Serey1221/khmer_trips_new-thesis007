<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230519_082011_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'img_url' => $this->string(),
            'name' => $this->string(100),
            'name_kh' => $this->string(100),
            'tourday' => $this->integer(),
            'tournight' => $this->integer(),
            'tourhour' => $this->integer(),
            'tourmin' => $this->integer(),
            'overview' => $this->text(),
            'overview_kh' => $this->text(),
            'highlight' => $this->text(),
            'highlight_kh' => $this->text(),
            'pick_up' => $this->string(),
            'pick_up_kh' => $this->string(),
            'drop_off' => $this->string(),
            'drop_off_kh' => $this->string(),
            'price_include' => $this->string(),
            'price_exclude' => $this->string(),
            'price_include_kh' => $this->string(),
            'price_exclude_kh' => $this->string(),
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->dateTime(),
            'deleted_by' => $this->integer(),
            'rate' => $this->decimal(),
            'status' => $this->tinyInteger(1),


        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
