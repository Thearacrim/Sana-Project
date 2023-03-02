<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $product_id
 * @property string $created_at
 * @property int $user_id
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'created_at', 'user_id'], 'required'],
            [['customer_id', 'product_id', 'user_id'], 'integer'],
            [['created_at','qty'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
            'qty' => 'QTY',
        ];
    }
   
}
