<?php

namespace app\modules\Admin\models;

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
            [['image_url'], 'file', 'extensions' => 'png, jpg, gif'],
            // [['image'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxFiles' => 0],

            // [['image_url'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['rate'], 'number'],
            [['status', 'image_url', 'description'], 'string', 'max' => 255],
            [['price', 'type_item'], 'string', 'max' => 100],
            [['created_date', 'created_by', 'updated_date', 'updated_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => Yii::t('app', 'title'),
            'category_id' => 'Category ID',
            'price' => Yii::t('app', 'price'),
            'created_by' => Yii::t('app', 'created_date'),
            'type_item' => 'Type Item',
            'image_url' => 'Image Url',
            'description' => 'Description',
            'rate' => 'Rate',
            'updated_date' => 'Updated Date',
            'created_date' => 'Created At',
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
            return '<span class="badge badge-pill badge-info">T-Shirt Women</span>';
        } else if ($this->type_item == 2) {
            return '<span class="badge badge-pill badge-danger">T-Shirt Man</span>';
        } else if ($this->type_item == 3) {
            return '<span class="badge badge-pill badge-success">Jeans Man</span>';
        } else if ($this->type_item == 4) {
            return '<span class="badge badge-pill badge-secondary">Jeans Woman</span>';
        } else if ($this->type_item == 5) {
            return '<span class="badge badge-pill badge-warning">Hoodies & Sweeter Man</span>';
        }else if ($this->type_item == 6) {
            return '<span class="badge badge-pill badge-warning">Hoodies & Sweeter Woman</span>';
        }else if ($this->type_item == 7) {
            return '<span class="badge badge-pill badge-warning">Shirts Short Sleeves Man</span>';
        }else if ($this->type_item == 8) {
            return '<span class="badge badge-pill badge-warning">Dresses & Jumpsuits</span>';
        }else if ($this->type_item == 9) {
            return '<span class="badge badge-pill badge-warning">Shirts Long Sleeves Man</span>';
        }else if ($this->type_item == 10) {
            return '<span class="badge badge-pill badge-warning">Sport Man</span>';
        }else if ($this->type_item == 11) {
            return '<span class="badge badge-pill badge-warning">OXFORD Shirt</span>';
        }else if ($this->type_item == 12) {
            return '<span class="badge badge-pill badge-warning">Hat Man</span>';
        } else if ($this->type_item == 13) {
            return '<span class="badge badge-pill badge-warning">Joggers Man</span>';
        }else if ($this->type_item == 14) {
            return '<span class="badge badge-pill badge-warning">Joggers Women</span>';
        }else if ($this->type_item == 15) {
            return '<span class="badge badge-pill badge-warning">Tanks</span>';
        }else if ($this->type_item == 16) {
            return '<span class="badge badge-pill badge-warning">Pants && Trousers Man</span>';
        }else if ($this->type_item == 17) {
            return '<span class="badge badge-pill badge-warning">Short Pants Man</span>';
        }else if ($this->type_item == 18) {
            return '<span class="badge badge-pill badge-warning">Sports</span>';
        }else if ($this->type_item == 19) {
            return '<span class="badge badge-pill badge-warning">Dresses & Jumpsuits</span>';
        }else if ($this->type_item == 20) {
            return '<span class="badge badge-pill badge-warning">Shirts & Tops Woman</span>';
        }else if ($this->type_item == 21) {
            return '<span class="badge badge-pill badge-warning">Jackets & Raincoats</span>';
        }else if ($this->type_item == 22) {
            return '<span class="badge badge-pill badge-warning">Pants & Trousers Woman</span>';
        }else if ($this->type_item == 23) {
            return '<span class="badge badge-pill badge-warning">Short Pants Woman</span>';
        }else if ($this->type_item == 24) {
            return '<span class="badge badge-pill badge-warning">Skirts Woman</span>';
        }else if ($this->type_item == 25) {
            return '<span class="badge badge-pill badge-warning">Shirts &Tops</span>';
        }else if ($this->type_item == 26) {
            return '<span class="badge badge-pill badge-warning">Jackets & Raincoats</span>';
        }else if ($this->type_item == 27) {
            return '<span class="badge badge-pill badge-warning">Headwear</span>';
        }
        else {
            return '<span class="badge badge-pill badge-primary">Watch</span>';
        }
    }

    public function getImageUrl()
    {
        return str_replace("app", '', Yii::$app->request->baseUrl) . "/" . $this->image_url;
    }
    public function getThumbUploadUrl()
    {
        $base_url = str_replace("app", '', Yii::$app->request->baseUrl);
        if (!$this->image_url) {
            return $base_url . '/uploads/placeholder.jpg';
        }
        return $base_url . '/' . $this->image_url;
    }
}