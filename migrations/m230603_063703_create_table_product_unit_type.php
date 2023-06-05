<?php

use yii\db\Migration;

/**
 * Class m230603_063703_create_table_product_unit_type
 */
class m230603_063703_create_table_product_unit_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_unit_type}}', [
            'id' => $this->primaryKey(),
            'unit_type_id' => $this->integer(),
            'product_id' => $this->integer(),
            'price' => $this->decimal(), 
        ]); 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063703_create_table_product_unit_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063703_create_table_product_unit_type cannot be reverted.\n";

        return false;
    }
    */
}
