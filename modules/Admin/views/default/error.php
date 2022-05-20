<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
Yii::$app->setHomeUrl(Yii::getAlias("@web/admin/default"));
?>
<div class="container text-center p-5 p-md-0">
    <div class="row mb-4">
        <div class="col-md-4 m-auto">
            <figure>
                <img class="img-fluid" src="https://vetra.laborasyon.com/assets/svg/404.svg" alt="image">
            </figure>
        </div>
    </div>
    <h2 class="display-6"><?= Html::encode($this->title) ?></h2>
    <p class="text-muted my-4"><?= nl2br(Html::encode($message)) ?></p>
    <div class="d-flex gap-3 justify-content-center">
        <a href="<?= Yii::$app->homeUrl; ?>" class="btn btn-primary">Home Page</a>
    </div>
</div>