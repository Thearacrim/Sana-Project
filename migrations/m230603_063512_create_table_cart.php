<?php

use yii\db\Migration;

/**
 * Class m230603_063512_create_table_cart
 */
class m230603_063512_create_table_cart extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'color_id' => $this->string(),
            'size_id' => $this->string(),
            'quantity' => $this->string(),
            'save_later' => $this->string(),
            'coupon_id' => $this->integer(),  
        ]); 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063512_create_table_cart cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063512_create_table_cart cannot be reverted.\n";

        return false;
    }
    */
}
