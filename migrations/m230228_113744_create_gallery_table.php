<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gallery}}`.
 */
class m230228_113744_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = $this->db->tablePrefix . 'gallery';
        if ($this->db->getTableSchema($tableName, true) != null) {
            $this->dropTable('{{%gallery}}');
        }
        $this->createTable('{{%gallery}}', [
            'id' => $this->primaryKey(),
            'img_url' => $this->string(255),
            'sub_title' => $this->string(100),
            'title' => $this->string(50),
            'description' => $this->string(255)
        ]);

        // // add foreign key for table `product`
        // $this->addForeignKey(
        //     'fk-gallery-product_id',
        //     'gallery',
        //     'product_id',
        //     'product',
        //     'id',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // // drops foreign key for table `product`
        // $this->dropForeignKey(
        //     'fk-gallery-product_id',
        //     'gallery'
        // );

        $this->dropTable('{{%gallery}}');
    }
}
