<?php

use yii\helpers\Url;

$base_url = Yii::getAlias('@web') ?>
<div class="container">
    <h2 class="text-center m-5 thanks text-color">Thanks for sub</h2>
    <div class="row">
        <div class="col-6">
            <img src=".<?php $base_url ?>./frontend/uploads/output-onlinegiftools (1).gif" alt="Success" class="cart-gif">
        </div>
        <div class="col-6">
            <a href="<?= Url::to(['site/']) ?>" class="btn btn-lg rounded-0 btn-outline-primary back_btn">Back To Page <i class="fa-solid fa-angles-right"></i></a>
        </div>
    </div>
</div>