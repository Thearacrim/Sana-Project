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
    /** @var \yii\web\UploadedFile[] $images */
    // public $images;
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
            [['image_relate'], 'file', 'extensions' => 'png, jpg, gif', 'maxFiles' => 5],
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

    /**
     * @param \yii\web\UploadedFile[] $images
     * @param number $productId
     * @param RelateImage|null $relateImage 
     */
    public static function uploads($images, $productId, $relateImage = null)
    {
        $upload_path = Yii::getAlias("uploads/");
        if (count($images) > 0) {
            $baseGallaryPath = $upload_path . 'products/' . $productId;

            if (!is_dir($baseGallaryPath)) {
                mkdir($baseGallaryPath, 0777, true);
            }

            if($relateImage){
                RelateImage::deleteAll(['product_id' => $productId]);
                foreach ($relateImage as $image) {
                    $baseUrl = Yii::getAlias('@web');
                    $deletePath = $baseUrl . $image->image_relate;
                    if (file_exists($deletePath)) {
                        unlink($deletePath);
                    }
                }
            }

            foreach ($images as $value) {
                $randomName = Yii::$app->security->generateRandomString(15);
                $fileName = $baseGallaryPath . '/' . $randomName . '.' . $value->extension;
                if ($value->saveAs($fileName)) {
                    $modelRelateImage = new RelateImage();
                    $modelRelateImage->image_relate = $fileName;
                    $modelRelateImage->product_id = $productId;
                    $modelRelateImage->create_at = date('Y-m-d h:m:s');
                    $modelRelateImage->save();
                }
            }
        }
    }
}
