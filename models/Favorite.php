<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorite".
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $product_id
 * @property int|null $user_id
 * @property int|null $qty
 * @property int|null $status
 * @property string|null $created_at
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'user_id', 'qty', 'status'], 'integer'],
            [['created_at'], 'safe'],
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
            'user_id' => 'User ID',
            'qty' => 'Qty',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
