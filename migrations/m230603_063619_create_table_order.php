<?php

use yii\db\Migration;

/**
 * Class m230603_063619_create_table_order
 */
class m230603_063619_create_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'customer_id' => $this->integer(),
            'note' => $this->string(),
            'sub_total' => $this->decimal(),
            'discount' => $this->decimal(),
            'grand_total' => $this->decimal(),   
            'created_date' => $this->dateTime(),
            'created_by' => $this->integer(),   
            'status' => $this->tinyInteger(),   
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063619_create_table_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063619_create_table_order cannot be reverted.\n";

        return false;
    }
    */
}
