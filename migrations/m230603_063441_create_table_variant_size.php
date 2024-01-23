<?php

use yii\db\Migration;

/**
 * Class m230603_063441_create_table_variant_size
 */
class m230603_063441_create_table_variant_size extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%variant_size}}', [
            'id' => $this->primaryKey(),
            'size' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063441_create_table_variant_size cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063441_create_table_variant_size cannot be reverted.\n";

        return false;
    }
    */
}
