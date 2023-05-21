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
            'created_at' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_at' => $this->dateTime(),
            'updated_by' => $this->integer(),
            'status' => $this->tinyInteger(1),
        ]);

        // // add foreign key for table `{{%country}}`
        // $this->addForeignKey(
        //     '{{%fk-city-country_id}}',
        //     '{{%city}}',
        //     'country_id',
        //     '{{%country}}',
        //     'id',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // // drops foreign key for table `{{%country}}`
        // $this->dropForeignKey(
        //     '{{%fk-city-country_id}}',
        //     '{{%city}}'
        // );


        $this->dropTable('{{%city}}');
    }
}
