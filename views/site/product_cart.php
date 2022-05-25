<?php

use yii\helpers\Url;

$base_url = Yii::getAlias("@web");
/*@var \yii\data\ActiveDataProvider $dataProvider*/

?>

<div class="card mb-4 product-wap rounded-0">
    <div class="card rounded-0">
        <img class="card-img rounded-0 img-fluid image-size" src="<?= $base_url . '/' . $model->image_url ?>" />
        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <a class="btn btn-success text-white" href="<?= Url::to('store-single') ?>"><i class="far fa-heart"></i></a>
                </li>
                <li>
                    <a class="btn btn-success text-white mt-2" href="<?= Url::to('store-single') ?>"><i class="far fa-eye"></i></a>
                </li>
                <li>
                    <a class="btn btn-success text-white btn-add-to-cart mt-2" href="#"><i class="fas fa-cart-plus"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <a href="<?= Url::to('store-single') ?>" class="h3 text-decoration-none"><?= $model->status ?></a>
        <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
            <li>M/L/X/XL</li>
            <li class="pt-2">
                <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
            </li>
        </ul>
        <ul class="list-unstyled d-flex justify-content-center mb-1">
            <li>
                <?=

                $star_str = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $model->rate) {
                        echo ' <i class="text-warning fa fa-star"></i>';
                    } else {
                        echo ' <i class="text-dark fa fa-star"></i>';
                    }
                }
                ?>
            </li>
        </ul>
        <p class="text-center mb-0">$<?= $model->price ?></p>
    </div>
</div>

<?php
$script = <<< JS
        $('.btn-add-to-cart').on('click',function() {
            
        });

        JS;
$this->registerJs($script);

?>

<!-- <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i> -->