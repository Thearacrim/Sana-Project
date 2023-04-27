<?php

use yii\bootstrap4\Modal;
use yii\helpers\Url;
use app\modules\Admin\models\Coupon;
use yii\helpers\Html;

$base_url = Yii::getAlias("@web");
$isFav = !empty($model->favorite)?'isFav':'';
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
<style>
.isFav:hover {
  background-color: #000;
  color: #fff;
  border-color: #000;
}

.isFav {
  background-color: #000;
  color: #fff;
  border-color: #000;
}
</style>
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
          <a class="btn btn-danger text-white btn-add-to-fav product-item  <?= $isFav?>" href="#"
            data-id="<?=$model->id?>"><i class="far fa-heart"></i></a>
        </li>
        <li>
          <a class="btn btn-danger text-white mt-2" href="<?= Url::to(['store-single', 'id' => $model->id]) ?>"><i
              class="far fa-eye"></i></a>
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