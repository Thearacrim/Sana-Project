<?php

use app\modules\Admin\models\User;
use app\modules\Admin\models\Cart;
use app\models\Favorite;

use yii\bootstrap4\Html;
use yii\helpers\Url;


$model = User::findOne(Yii::$app->user->id);
$base_url = Yii::getAlias("@web");

if (\Yii::$app->user->isGuest) {
  $totalCart = 0;
} else {
  $userId = Yii::$app->user->id;
  $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
  $totalCart = $totalCart->quantity;
};


if (Yii::$app->user->isGuest) {
  $favoritestotal = 0;
} else {
  $userId = Yii::$app->user->id;
  $favoritestotal = Favorite::find()->select(['SUM(qty) qty'])->where(['user_id' => $userId])->one();
  $favoritestotal = $favoritestotal->qty;
};

?>

<!-- Header -->
<nav class="navbar navbar-expand-lg back-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand" href="<?= Url::to(['site/add-cart']) ?>">
            <img class="" src="<?= $base_url ?>/template/img/logo2.png" style="width:8rem" ;height="8rem">
        </a>
        <button class="navbar-toggler text-color text-dark" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="templatemo_main_nav" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-color"></i>
        </button>

        <div class="align-self-center collapse navbar-collapse justify-content-lg-between mt-3"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-start mx-lg-auto">
                    <li class="nav-item text-color">
                        <a class="link-brand" href="<?= Url::to(['site/store-man']) ?>">Man</a>
                    </li>
                    <li class="nav-item text-color">
                        <a class="link-brand" href="<?= Url::to(['site/store-women']) ?>">Women</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <a class="nav-icon d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search mr-2 text-color"></i>
                </a>
                <!-- add-fav -->    
                 <!-- <a class="nav-icon position-relative text-decoration-none" value="login" href="<?= Url::to(['site/favorites']) ?>">
                    <i class="far fa-heart fa-cart-arrow-down text-color mr-1"></i>
                    <span id="favortie-quantity" class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $favoritestotal?></span>
                </a> -->
        <?php 

            if(Yii::$app->user->isGuest){
                ?>
                    <a class="nav-icon position-relative text-decoration-none" value="login" href="<?= Url::to(['site/login']) ?>">
                    <i class="far fa-heart fa-cart-arrow-down text-color mr-1"></i>
                    <span id="favortie-quantity" class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $favoritestotal?></span>
                </a>

                <?php
            }else{
                ?>
                    <a class="nav-icon position-relative text-decoration-none" value="login" href="<?= Url::to(['/site/favorites']) ?>">
                    <i class="far fa-heart fa-cart-arrow-down text-color mr-1"></i>
                    <span id="favortie-quantity" class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $favoritestotal?></span>
                    </a>


                <?php
            }
        
        ?>
                <?php
        if (Yii::$app->user->isGuest) {
        ?>

          <a class="nav-icon position-relative text-decoration-none" value="login" href="<?= Url::to(['/site/login']) ?>">
            <i class="fa fa-fw fa-cart-arrow-down text-color mr-1"></i>
            <span id="cart-quantity" class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
          </a>
        <?php

        } else {
        ?>
                <a class="nav-icon position-relative text-decoration-none" href="<?= Url::to(['site/cart']) ?>">
                    <i class="fa fa-fw fa-cart-arrow-down text-color mr-1"></i>
                    <span id="cart-quantity"
                        class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
                </a>
                <?php
        }
        $language = Yii::$app->language;
        if ($language == 'en-US') { ?>
                <form id="lang-form" action="/Zay/site/language" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf"
                        value="V53vWUVNd-NefwfinKxGFU3IetycNr1mfZv2msWI25sa8JsOdBcbgTwSctHM9QpQHbsf6utX9ioYyJncitCjrw==">
                    <select name="language" id="lang">
                        <option value="en-US" selected>English</option>
                        <option value="kh-KM">Khmer</option>
                    </select>
                </form>
                <?php } else { ?>
                <form id="lang-form" action="/Zay/site/language" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf"
                        value="V53vWUVNd-NefwfinKxGFU3IetycNr1mfZv2msWI25sa8JsOdBcbgTwSctHM9QpQHbsf6utX9ioYyJncitCjrw==">
                    <select name="language">
                        <option value="en-US">English</option>
                        <option value="kh-KM" selected>Khmer</option>
                    </select>
                </form>
                <?php }
        ?>
                <?php
        if (Yii::$app->user->isGuest) {
        ?>

          <a style="cursor:poiter" href="<?= Url::to(['/site/login']) ?>" class="pl-3"><i class="fas fa-user"></i></a>
          <!-- <span class="text-dark p-3 fw-bold">|</span>
          <a style="cursor:poiter" value="<?= Url::to(['/site/sign']) ?>" class="trigggerModal">SignUp<i class="fas fa-sign-up-alt"></i></a> -->
        <?php

        } else {
        ?>
                <?php $menuItems[] = ['label' => ''] ?>
                <div class="btn-group pl-3">
                    <div class="dropdown">
                        <a class="dropdown-toggle pr-5" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                            data-bs-toggle="dropdown" data-bs-display="static" aria-haspopup="true"
                            aria-expanded="false">
                            <!-- <img class="rounded-circle" src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>" style="width:40px;height:40px" alt="profile"> -->
                        </a>
                        <div class=" dropdown-menu back-light" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item d-flex justify-content-between"
                                href="<?= Url::to(['site/profile']) ?>">
                                <?php 
                    if($model->image_url == null){
                        ?>
                                <img class="rounded-circle mr-3"
                                    src="<?= $base_url ?>/uploads/orionthemes-placeholder-image-1.png ?> ?>"
                                    style="width:60px;height:60px;object-fit: cover;" alt="profile">
                                <?php }else{?>
                                <img class="rounded-circle mr-3"
                                    src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>"
                                    style="width:60px;height:60px;object-fit: cover;" alt="profile">
                                <?php }?>
                                <div>
                                    <span style="font-size:1.3rem"
                                        class="fw-bold text-dark"><?= Yii::$app->user->identity->username ?></span><br>
                                    <span style="font-size:0.8rem"
                                        class="fw-bold text-dark"><?= Yii::$app->user->identity->email ?></span>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item text-dark" href="#">Another action</a>
                            <a class="dropdown-item text-dark" href="#">Cart</a>
                            <a class="dropdown-item text-dark" href="#">New Order</a>
                            <a class="dropdown-item text-dark" href="#">Payment</a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item text-dark" href="<?php Url::to(['site/help']) ?>">Help</a>
                            <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post'], 'class' => 'dropdown-item text-dark']) ?>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>
            </div>
        </div>

    </div>
</nav>
<!-- Close Header -->

<?php
$add_cart_url = Url::to(['site/change-quantity']);
$base_url = Url::to(['language']);
$script = <<< JS
            // $("#main").change(function () {
              $("form#lang-form").change(function () {
            var form = $(this);
            // submit form
            $.ajax({
                url: '$base_url',
                type: "post",
                data: form.serialize(),
                success: function (response) {
                    // reload the page after selecting a language
                    location.reload();
                },
                error: function () {
                    console.log("Ajax: internal server error");
                }
            });
            return false;
        });
        JS;
$this->registerJs($script);

?>