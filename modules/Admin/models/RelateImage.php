<?php

namespace app\modules\Admin\models;

use Yii;

/**
 * This is the model class for table "relate_image".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $image_relate
 * @property string|null $create_at
 */
class RelateImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relate_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['create_at'], 'safe'],
            [['image_relate'], 'file', 'extensions' => 'png, jpg, gif','maxFiles'=>5],
            // [['image_relate'], 'file', 'extensions' => 'png, jpg, gif','maxFiles'=>5,'skipOnEmpty'=>false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'image_relate' => 'Image Relate',
            'create_at' => 'Create At',
        ];
    }
    public function getImageUrl()
    {
        return str_replace("app", '', Yii::$app->request->baseUrl) . "/" . $this->image_relate;
    }
    public function getThumbUploadUrl()
    {
        $base_url = str_replace("app", '', Yii::$app->request->baseUrl);
        if (!$this->image_relate) {
            return $base_url . '/uploads/placeholder.jpg';
        }
        return $base_url . '/' . $this->image_relate;
    }
}