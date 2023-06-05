<?php

use yii\db\Migration;

/**
 * Class m230603_063555_create_table_favorite
 */
class m230603_063555_create_table_favorite extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorite}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'product_id' => $this->integer(),
            'user_id' => $this->integer(),
            'qty' => $this->integer(),
            'status' => $this->tinyInteger(),
            'created_at' => $this->dateTime(),
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063555_create_table_favorite cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063555_create_table_favorite cannot be reverted.\n";

        return false;
    }
    */
}
