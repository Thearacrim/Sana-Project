<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property int $id
 * @property string|null $Customer
 * @property string|null $Issue_date
 * @property string|null $Due_date
 * @property string|null $Type
 * @property string|null $status
 */
class Invoices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Customer'], 'integer'],
            [['Issue_date', 'Due_date'], 'safe'],
            [['status'], 'string'],
            [['Type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Customer' => 'Customer',
            'Issue_date' => 'Issue Date',
            'Due_date' => 'Due Date',
            'Type' => 'Type',
            'status' => 'Status',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // $this->slug = Yii::$app->formater->slugify($this->slug);
            if ($this->isNewRecord) {
                $this->Issue_date = date('Y-m-d H:i:s');
            } else {
                $this->Due_date = date('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }
    public function getStatus()
    {
        if ($this->status == 'Paid') {
            return '<span class="badge badge-pill badge-info">Paid</span>';
        } else {
            return '<span class="badge badge-pill badge-primary">Open</span>';
        }
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'Customer']);
    }
}
