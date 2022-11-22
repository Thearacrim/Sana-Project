<?php

/** @var \yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use app\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$base_url = Yii::getAlias("@web");
$view;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <link rel="icon" href="<?= Yii::getAlias('@web') ?>/template/img/favicon.ico" />
  <meta charset="<?= Yii::$app->charset ?>">
  <?php $this->head() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<?php
Modal::begin([
  'id' => 'modal',
  'size' => 'modal-md',
]);
echo "<div id='modalContent'></div>";
Modal::end();
?>

<body class="back-light" id="themeMode">
  <?php $this->beginBody() ?>

  <?= $this->render("promotion", ['base_url' => $base_url]) ?>

  <?= $this->render("top_nav", ['base_url' => $base_url]) ?>

  <?= $this->render("header", ['base_url' => $base_url]) ?>
  <!-- <main id="swup" class="transition-fade"> -->

  <?= $this->render("modal", ['base_url' => $base_url]) ?>

  <?= $this->render("banner", ['base_url' => $base_url]) ?>

  <?= $content ?>

  <?= $this->render("footer", ['base_url' => $base_url]) ?>
  <!-- </main> -->
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage(); ?>
<?php

$script = <<< JS
$(document).on("click",".trigggerModal",function(){
  $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
});
JS;
$this->registerJs($script);

?>