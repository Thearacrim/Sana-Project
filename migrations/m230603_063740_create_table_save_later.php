<?php

use yii\db\Migration;

/**
 * Class m230603_063740_create_table_save_later
 */
class m230603_063740_create_table_save_later extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%save_later}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),  
        ]); 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063740_create_table_save_later cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063740_create_table_save_later cannot be reverted.\n";

        return false;
    }
    */
}
