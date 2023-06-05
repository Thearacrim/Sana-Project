<?php

use yii\db\Migration;

/**
 * Class m230603_063648_create_table_product
 */
class m230603_063648_create_table_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'category_id' => $this->integer(),
            'price' => $this->string(),
            'image_url' => $this->string(),
            'description' => $this->string(),
            'type_item' => $this->integer(),   
            'rate' => $this->decimal(),
            'created_date' => $this->dateTime(),
            'created_by' => $this->integer(),
            'updated_date' => $this->dateTime(),   
            'change_status' => $this->integer(),   

        ]); 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063648_create_table_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063648_create_table_product cannot be reverted.\n";

        return false;
    }
    */
}
