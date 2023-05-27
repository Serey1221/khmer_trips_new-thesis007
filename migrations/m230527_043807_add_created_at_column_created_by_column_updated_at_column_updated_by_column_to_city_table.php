<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%city}}`.
 */
class m230527_043807_add_created_at_column_created_by_column_updated_at_column_updated_by_column_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%city}}', 'created_at', $this->datetime());
        $this->addColumn('{{%city}}', 'created_by', $this->integer());
        $this->addColumn('{{%city}}', 'updated_at', $this->datetime());
        $this->addColumn('{{%city}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%city}}', 'created_at');
        $this->dropColumn('{{%city}}', 'created_by');
        $this->dropColumn('{{%city}}', 'updated_at');
        $this->dropColumn('{{%city}}', 'updated_by');
    }
}
