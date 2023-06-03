<?php

use yii\db\Migration;

/**
 * Class m230603_051150_create_table_banner
 */
class m230603_051150_create_table_banner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'color_id' => $this->string(250),
            'size_id' => $this->string(100),
            'quantity' =>$this->string(100),
            'save_later' => $this->string(100),
            'coupon_id' => $this->integer(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_051150_create_table_banner cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_051150_create_table_banner cannot be reverted.\n";

        return false;
    }
    */
}
