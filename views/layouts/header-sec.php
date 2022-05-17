<?php

/** @var \yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap4\Html;


$base_url = Yii::getAlias("@web");

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <link rel="icon" href="<?= Yii::getAlias('@web') ?>/template/img/banner_img_03.jpg" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="72" class="position-relative back-light">
    <?php $this->beginBody() ?>
    <header class="fixed-top page-header">
        <?= $this->render("top_nav", ['base_url' => $base_url]) ?>
        <?= $this->render("header", ['base_url' => $base_url]) ?>
    </header>
    <div class="header-space"></div>
    <?= $this->render("modal", ['base_url' => $base_url]) ?>

    <?= $content ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage(); ?>