<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_address".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $customer_id
 * @property string|null $phone_number
 * @property string|null $address
 * @property string|null $city
 */
class OrderAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'city','phone_number'], 'required'],
            [['user_id', 'customer_id'], 'integer'],
            [['phone_number'], 'string', 'max' => 100],
            [['address', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'customer_id' => 'Customer ID',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'city' => 'City',
        ];
    }
}