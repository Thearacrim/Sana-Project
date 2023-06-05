<?php

use yii\db\Migration;

/**
 * Class m230603_063526_create_table_coupon
 */
class m230603_063526_create_table_coupon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%coupon}}', [
            'id' => $this->primaryKey(),
            'coupon_title' => $this->string(),
            'coupon_code' => $this->decimal(),
            'discount' => $this->decimal(),
            'discount_on' => "ENUM('all product','clothes','shose')",
            'coupon_type' => "ENUM('percentage','amount')",
            'created_date' => $this->dateTime(),
            'expire_date' => $this->dateTime(),
            'status' => "ENUM('draft','public')",  
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063526_create_table_coupon cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063526_create_table_coupon cannot be reverted.\n";

        return false;
    }
    */
}
