<?php

use yii\helpers\Url;

$base_url = Yii::getAlias('@web') ?>
<div class="container" style="margin-top:13rem">
    <h2 class="text-center m-5 text-bold">Thanks for sub</h2>
    <div class="row">
        <div class="col-8">
            <img src=".<?php $base_url ?>./frontend/uploads/e507d704d4b6fdcb17116762fcd99acd.gif" alt="Success">
        </div>
        <div class="col-4">
            <a href="<?= Url::to(['site/']) ?>" class="btn btn-lg rounded-0 btn-outline-primary w-75 back_btn">Back To Page <i class="fa-solid fa-angles-right"></i></a>
        </div>
    </div>
</div>