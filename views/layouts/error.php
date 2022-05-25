<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AdminAsset;
use yii\helpers\Url;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/img/fav.svg" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body style="background-color:#001">
    <?php $this->beginBody() ?>

    <main class="empty-state empty-state-fullpage bg-black">
        <div class="empty-state-container">
            <?= $content ?>
        </div>
    </main>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>