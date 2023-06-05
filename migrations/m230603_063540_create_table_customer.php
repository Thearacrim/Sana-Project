<?php

use yii\db\Migration;

/**
 * Class m230603_063540_create_table_customer
 */
class m230603_063540_create_table_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(),
            'city' => $this->string(),
            'phone_number' => $this->string(),
            'user_id' => $this->integer(),
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063540_create_table_customer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063540_create_table_customer cannot be reverted.\n";

        return false;
    }
    */
}
