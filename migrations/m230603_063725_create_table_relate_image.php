<?php

use yii\db\Migration;

/**
 * Class m230603_063725_create_table_relate_image
 */
class m230603_063725_create_table_relate_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%relate_image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'image_relate' => $this->string(),
            'create_at' => $this->dateTime(), 
        ]); 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063725_create_table_relate_image cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063725_create_table_relate_image cannot be reverted.\n";

        return false;
    }
    */
}
