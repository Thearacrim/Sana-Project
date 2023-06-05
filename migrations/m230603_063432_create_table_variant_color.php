<?php

use yii\db\Migration;

/**
 * Class m230603_063432_create_table_variant_color
 */
class m230603_063432_create_table_variant_color extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%variant_color}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230603_063432_create_table_variant_color cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230603_063432_create_table_variant_color cannot be reverted.\n";

        return false;
    }
    */
}
