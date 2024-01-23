<?php

use yii\db\Migration;

/**
 * Class m230603_063635_create_table_order_item
 */
class m230603_063635_create_table_order_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'size' => $this->integer(),
            'color' => $this->integer(),
            'qty' => $this->integer(),
            'price' => $this->decimal(),   
            'discount' => $this->decimal(),
            'total' => $this->decimal(),   
            'created_date' => $this->dateTime (),   
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063635_create_table_order_item cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063635_create_table_order_item cannot be reverted.\n";

        return false;
    }
    */
}
