<?php

use yii\db\Migration;

/**
 * Class m230603_060445_create_table_coupon
 */
class m230603_060445_create_table_coupon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
           
            
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_060445_create_table_coupon cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_060445_create_table_coupon cannot be reverted.\n";

        return false;
    }
    */
}
