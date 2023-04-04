<?php

/** @var \yii\web\View $this */
/** @var string $content */

use app\assets\LoginAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

LoginAsset::register($this);
$url_web = Yii::getAlias('@web');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="<?= $url_web ?>/frontend/template/img/output-onlinepngtools1.png" />
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<style>
  /* body {
    background-image: url(img/level_store.jpg);
    background-size: 800px;
    background-repeat: repeat-x;
  } */
  .auth_header {
    position: relative;
    padding: 2rem 1.25rem 0;
    width: 100%;
    background-color: #346cb0;
    color: #fff;
    text-align: center;
    background-size: cover;
  }

  .card {
    bottom: 22%;
  }

  @media (max-width: 575.98px) {
    .auth_header {
      width: 100% !important;
      height: 200px !important;
    }

    .form-control {
      font-size: 0.9rem !important;
    }

    .background-img {
      width: 20rem !important;
    }

    .contenet {
      position: absolute;
      width: 454px;
      right: -97px;
    }
  }
</style>

<body class="bg-gradient-primary">
  <?php $this->beginBody() ?>
  <main>
    <header class="auth_header">
      <img src="img/Frame_3-removebg-preview.png" class="background-img" width="35%" />
    </header>

    <div class="container">
      <div class="row d-flex justify-content-center ">
        <div class="col-sm-6">
          <div class="card shadow-lg m-5 phone_screen">
            <div class="card-body p-0">
              <div class="p-5 contenet">
                <?= $content ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
