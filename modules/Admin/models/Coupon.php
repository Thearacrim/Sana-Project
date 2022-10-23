<?php

namespace app\modules\Admin\models;

use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property int $id
 * @property string|null $coupon_title
 * @property float|null $coupon_code
 * @property float|null $discount
 * @property string|null $discount_on
 * @property string|null $coupon_type
 * @property string|null $created_date
 * @property string|null $expire_date
 * @property string|null $status
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coupon_code', 'discount'], 'number'],
            [['discount_on', 'coupon_type', 'status'], 'string'],
            [['created_date', 'expire_date'], 'safe'],
            [['coupon_title'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon_title' => 'Coupon Title',
            'coupon_code' => 'Coupon Code',
            'discount' => 'Discount',
            'discount_on' => 'Discount On',
            'coupon_type' => 'Coupon Type',
            'created_date' => 'Created Date',
            'expire_date' => 'Expire Date',
            'status' => 'Status',
        ];
    }
    public function getTypeStatus()
    {
        if ($this->status == 'public') {
            return '<span class="card border-left-success rounded-0 back-light">Public</span>';
        } else {
            return '<span class="card border-left-danger rounded-0 back-light">Draft</span>';
        }
    }
}
