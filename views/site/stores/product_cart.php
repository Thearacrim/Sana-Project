<?php

use yii\bootstrap4\Modal;
use yii\helpers\Url;

$base_url = Yii::getAlias("@web");
/*@var \yii\data\ActiveDataProvider $dataProvider*/

?>
<!-- data-aos="zoom-in-down" data-aos-duration="2000" -->
<div class="card mb-4 product-wap rounded-0 block">
    <div class="card rounded-0">
        <img class="card-img rounded-0 image-size" src="<?= $base_url . '/frontend/' . $model->image_url ?>" />
        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
                    <a class="btn btn-success text-white" href="<?= Url::to('store-single') ?>"><i class="far fa-heart"></i></a>
                </li>
                <li>
                    <a class="btn btn-success text-white mt-2" href="<?= Url::to('store-single?id=' . $model->id) ?>"><i class="far fa-eye"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <a href="<?= Url::to('store-single') ?>" class="h3 text-decoration-none"><?= $model->status ?></a><br>
        <span class="" style="font-size:1.2rem; font-weight:700">$<?= $model->price ?></span>
    </div>
</div>

<?php

$script = <<< JS
        AOS.init();
        JS;
$this->registerJs($script);

?>