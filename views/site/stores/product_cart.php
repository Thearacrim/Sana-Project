<?php

use yii\bootstrap4\Modal;
use yii\helpers\Url;
use app\modules\Admin\models\Coupon;

$base_url = Yii::getAlias("@web");
?>
<?php $discount = Yii::$app->db->createCommand("SELECT
        discount
    FROM
        `coupon` 
    WHERE
    CURDATE() < expire_date
            ")
    ->queryScalar();
$discountCal = $model->price * ($discount / 100);
?>

<!-- data-aos="zoom-in-down" data-aos-duration="2000" -->
<div class="card mb-4 product-wap rounded-0">
    <div class="card rounded-0">
        <?php if ($discount) {
        ?>
        <div class="ribbon-wrapper">
            <div class="ribbon-tag">Hot Deals</div>
        </div>
        <?php
        } else {
        } ?>
        <img class="card-img-top rounded-0 w-100" src="<?= $base_url . '/' . $model->image_url ?>"
            style="height:350px;object-fit: cover;" />
        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
            <ul class="list-unstyled">
                <li>
<<<<<<< HEAD
<<<<<<< HEAD
                    <a class="btn btn-danger text-white" href="<?= Url::toRoute('store-single') ?>"><i
                            class="far fa-heart"></i></a>
=======
                    <a class="btn btn-danger text-white btn-add-to-fav product-item  <?= $isFav?>" href="#" data-id="<?=$model->id?>"><i class="far fa-heart"></i></a>
>>>>>>> 687a2fec6ce16234f38526ecd137a60c67f7f9fe
=======
                    <a class="btn btn-danger text-white" href="<?= Url::toRoute('store-single') ?>"><i class="far fa-heart"></i></a>
>>>>>>> parent of d654843 (update_favorite)
                </li>
                <li>
                    <a class="btn btn-danger text-white mt-2"
                        href="<?= Url::to(['store-single', 'id' => $model->id]) ?>"><i class="far fa-eye"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <a href="<?= Url::to('store-single') ?>" class="h3 text-decoration-none"><?= $model->status ?></a><br>
        <?php if ($discount) {
        ?>
        <span class=""
            style="font-size:1.2rem; font-weight:700;text-decoration: line-through;">$<?= $model->price ?></span><br>
        <span class="" style="font-size:1.5rem; font-weight:700;">$<?= $model->price - $discountCal ?></span>
        <?php
        } else {
            ?>
        <span class="" style="font-size:1.2rem; font-weight:700">$<?= $model->price ?></span><br>
        <?php
        } ?>
    </div>
</div>

<?php

$script = <<< JS
        AOS.init();
        JS;
$this->registerJs($script);

?>