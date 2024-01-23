<?php

use yii\db\Migration;

/**
 * Class m230603_063501_create_table_banner
 */
class m230603_063501_create_table_banner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'sort_description' => $this->string(),
            'description' => $this->string(),
            'image_banner' => $this->string(),
            'banner_type' => $this->integer(),
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063501_create_table_banner cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063501_create_table_banner cannot be reverted.\n";

        return false;
    }
    */
}
