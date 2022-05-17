<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
Yii::$app->setHomeUrl(Yii::getAlias("@web/admin/default"));
?>
<div class="site-error d-flex justify-content-center" style="padding-top:5rem">
    <div>
        <img class="img-fluid" src="<?= Yii::getAlias("@web") ?>/frontend/template/img/img-2.svg" alt="" style="max-width: 320px">
        <h3 class="state-header"> <?= Html::encode($this->title) ?> </h3>
        <p class="state-description lead"> <?= nl2br(Html::encode($message)) ?></p>
        <a href="<?= Yii::$app->homeUrl; ?>" class="btn btn-lg btn-danger"><i class="fa fa-angle-right"></i> Go Home</a>
    </div>
</div>