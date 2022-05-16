<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $status
 * @property int|null $category_id
 * @property string|null $price
 * @property string|null $image_url
 * @property string|null $description
 * @property float|null $rate
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'description', 'price', 'status'], 'required'],
            [['category_id'], 'integer'],
            [['image_url'], 'file'],
            // [['image_url'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['rate'], 'number'],
            [['status', 'image_url', 'description'], 'string', 'max' => 255],
            [['price', 'type_item'], 'string', 'max' => 100],
            [['created_date', 'created_by', 'updated_date', 'updated_by'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Title',
            'category_id' => 'Category ID',
            'price' => 'Price',
            'created_by' => 'Created By',
            'type_item' => 'Type Item',
            'image_url' => 'Image Url',
            'description' => 'Description',
            'rate' => 'Rate',
            'updated_date' => 'Updated Date',
            'created_date' => 'Created At'
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
                $this->updated_date = date('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }
    public function getTypeTemp()
    {
        if ($this->type_item == 1) {
            return '<span class="badge badge-pill badge-info">Women</span>';
        } else if ($this->type_item == 2) {
            return '<span class="badge badge-pill badge-danger">Man</span>';
        } else if ($this->type_item == 3) {
            return '<span class="badge badge-pill badge-success">Sport</span>';
        } else if ($this->type_item == 4) {
            return '<span class="badge badge-pill badge-secondary">Bag</span>';
        } else if ($this->type_item == 5) {
            return '<span class="badge badge-pill badge-warning">Watch</span>';
        } else {
            return '<span class="badge badge-pill badge-primary">Watch</span>';
        }
    }

    public function getImageUrl()
    {
        return str_replace("app", 'frontend', Yii::$app->request->baseUrl) . "/" . $this->image_url;
    }
    public function getThumbUploadUrl()
    {
        $base_url_frontend = str_replace("app", 'frontend', Yii::$app->request->baseUrl);
        if (!$this->image_url) {
            return $base_url_frontend . '/uploads/placeholder.jpg';
        }
        return $base_url_frontend . '/' . $this->image_url;
    }
}
