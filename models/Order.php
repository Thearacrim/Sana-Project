<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string|null $code
 * @property int|null $customer_id
 * @property string|null $note
 * @property float|null $sub_total
 * @property float|null $discount
 * @property float|null $grand_total
 * @property int|null $status
 * @property string|null $created_date
 * @property int|null $created_by
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'status', 'created_by'], 'integer'],
            [['sub_total', 'discount', 'grand_total'], 'number'],
            [['created_date'], 'safe'],
            [['code'], 'string', 'max' => 25],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'customer_id' => 'Customer ID',
            'note' => 'Note',
            'sub_total' => 'Sub Total',
            'discount' => 'Discount',
            'grand_total' => 'Grand Total',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // $this->slug = Yii::$app->formater->slugify($this->slug);
            if ($this->isNewRecord) {
                $this->created_date = date('Y-m-d H:i:s');
                $this->created_by = Yii::$app->user->identity->id;
            } else {
            }
            return true;
        } else {
            return false;
        }
    }
    public function getTypeTemp()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-pill badge-info">Complete</span>';
        } else {
            return '<span class="badge badge-pill badge-danger">In-Order</span>';
        }
    }
    public function getOrder()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }
}
