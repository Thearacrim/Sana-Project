<?php

use app\modules\Admin\models\User;
use app\modules\Admin\models\Cart;
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
}
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
                    <li class="dropdown">
                        <a href="<?= Url::to(['site/store-man']) ?>" class="dropdown-toggle a-title" data-toggle="">MAN
                            <b class="caret"></b></a>

                        <ul class="dropdown-menu mega-menu" style="background-color: #edf2fc;">
                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">ALL TOPS</li>
                                    <li><a href="<?= Url::to(['site/store-top-tshirt-man']) ?>">T-Shirts</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Hoodies & Sweaters</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Shirts Short Sleeves</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Shirts Long Sleeves</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">OXFORD Shirt</a></li>
                                    <!-- <li><a href="#">Jackets & Raincoats</a></li> -->
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">ALL BOTTOMS</li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-jean-man']) ?>">Jeans</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Pants & Trousers</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Joggers</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Short Pants</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-man']) ?>">Sport</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">ALL ACCESSORIES</li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Hat</a></li>
                                    <!-- <li><a href="#">Backpacks</a></li>
                                    <li><a href="#">Footwear</a></li>
                                    <li><a href="#">Socks</a></li>
                                    <li><a href="#">Bumbags</a></li>
                                    <li><a href="#">Wallets & Clutch Bags</a></li> -->
                                </ul>
                            </li>

                        </ul><!-- dropdown-menu -->

                    </li>
                    <li class="dropdown">
                        <a href="<?= Url::to(['site/store-women']) ?>" class="dropdown-toggle a-title"
                            data-toggle="">WOMEN <b class="caret"></b></a>

                        <ul class="dropdown-menu mega-menu" style="background-color: #edf2fc;">
                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">ALL TOPS</li>
                                    <li><a href="<?= Url::to(['site/store-top-tshirt-woman']) ?>">T-Shirts</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Hoodies &
                                            Sweaters</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Shirts Short
                                            Sleeves</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Shirts Long
                                            Sleeves</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Polo Shirts</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Jackets &
                                            Raincoats</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">ALL BOTTOMS</li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-jean-woman']) ?>">Jeans</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Pants &
                                            Trousers</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Joggers</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Short Pants</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Underwear</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-hat-man']) ?>">Swimwear</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header">ALL ACCESSORIES</li>
                                    <li><a href="#">Headwear</a></li>
                                    <li><a href="#">Backpacks</a></li>
                                    <li><a href="#">Footwear</a></li>
                                    <li><a href="#">Socks</a></li>
                                    <li><a href="#">Bumbags</a></li>
                                    <li><a href="#">Wallets & Clutch Bags</a></li>
                                </ul>
                            </li>

                        </ul><!-- dropdown-menu -->

                    </li>
                    <!-- <li class="nav-item text-color">
                        <a class="link-brand" href="<?= Url::to(['site/store-women']) ?>">Women</a>
                    </li> -->
                </ul>
            </div>
            <div class="navbar1 align-self-center d-flex">
                <a class="nav-icon d-lg-inline icon-menu" href="#" data-bs-toggle="modal"
                    data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search mr-2 text-color"></i>
                </a>
                <a class="nav-icon d-lg-inline icon-menu" href="#">
                    <i class="far fa-heart mr-2 text-color"></i>
                </a>
                <?php
        if (Yii::$app->user->isGuest) {
        ?>

                <a class="nav-icon position-relative text-decoration-none" value="login"
                    href="<?= Url::to(['/site/login']) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="1.5rem"
                        class="bag-icon" height="1.5rem">
                        <path
                            d="M21,6H18A6,6,0,0,0,6,6H3A3,3,0,0,0,0,9V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V9A3,3,0,0,0,21,6ZM12,2a4,4,0,0,1,4,4H8A4,4,0,0,1,12,2ZM22,19a3,3,0,0,1-3,3H5a3,3,0,0,1-3-3V9A1,1,0,0,1,3,8H6v2a1,1,0,0,0,2,0V8h8v2a1,1,0,0,0,2,0V8h3a1,1,0,0,1,1,1Z" />
                    </svg>
                    <span id="cart-quantity"
                        class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
                </a>
                <?php

        } else {
        ?>
                <a class="nav-icon position-relative text-decoration-none bag-shop"
                    href="<?= Url::to(['site/cart']) ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="1.5rem"
                        class="bag-icon" height="1.5rem">
                        <path
                            d="M21,6H18A6,6,0,0,0,6,6H3A3,3,0,0,0,0,9V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V9A3,3,0,0,0,21,6ZM12,2a4,4,0,0,1,4,4H8A4,4,0,0,1,12,2ZM22,19a3,3,0,0,1-3,3H5a3,3,0,0,1-3-3V9A1,1,0,0,1,3,8H6v2a1,1,0,0,0,2,0V8h8v2a1,1,0,0,0,2,0V8h3a1,1,0,0,1,1,1Z" />
                    </svg>
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

                <a style="cursor:poiter" href="<?= Url::to(['/site/login']) ?>" class="pl-3"><i
                        class="fas fa-user"></i></a>
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