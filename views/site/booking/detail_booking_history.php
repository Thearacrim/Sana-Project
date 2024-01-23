<?php

/* @var $this yii\web\View */

use app\models\OrderItem;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Booking Histroy';
$base_url = Yii::getAlias("@web");
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->isGuest) {
    $userId = Yii::$app->user->id;
};

?>

<section class="h-100 gradient-custom">
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Booking Details</h5>
                    </div>
                    <?php foreach ($mybooking as $key => $value) : ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                        <img src="<?= $base_url . '' . $value['image_url'] ?>" class="w-100" />
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <!-- Data -->
                                    <p><strong><?= $value['status'] ?></strong></p>
                                    <p>Color: <?= $value['color'] ?></p>
                                    <p>Size: <?= $value['size'] ?></p>
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <p class="text-start">
                                        <label for="">QTY :</label>
                                        <strong><?= $value['qty'] ?></strong>
                                    </p>

                                    <p class="text-start">
                                        <label for="">Price :</label>
                                        <strong>$<?= $value['price'] ?></strong>
                                    </p>
                                    <p class="text-start">
                                        <label for="">Amount :</label>
                                        <strong>$<?= $value['total'] ?></strong>
                                    </p>
                                </div>
                                <hr class="my-4" />
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">BILLING INFORMATION</h5>
                    </div>
                    <div class="card-body">
                        <?php foreach ($customer as $key => $value) : ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Name:
                                    <span> <?= $value['name'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    City:
                                    <span><?= $value['city'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Tel:
                                    <span><?= $value['phone_number'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between border-0 px-0 pb-0">
                                    Address:
                                    <span><?= $value['address'] ?></span>
                                </li>

                            </ul>
                            <br>
                            <button type="button" class="btn btn-primary btn-lg btn-block">
                                Back
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>