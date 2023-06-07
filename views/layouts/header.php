<?php

use app\modules\Admin\models\User;
use app\modules\Admin\models\Cart;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use app\models\Favorite;

$model = User::findOne(Yii::$app->user->id);
$favorite = Favorite::find()->one();
$base_url = Yii::getAlias("@web");

if (\Yii::$app->user->isGuest) {
  $totalCart = '';
} else {
  $userId = Yii::$app->user->id;
  $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
  $totalCart = $totalCart->quantity;
};
if (Yii::$app->user->isGuest) {
  $favoritestotal = '';
} else {
  $userId = Yii::$app->user->id;
  $favoritestotal = Favorite::find()->select(['SUM(qty) qty'])->where(['user_id' => $userId])->one();
  $favoritestotal = $favoritestotal->qty;
};
?>
<style>
.profile_user {
    left: 28px;
}

.not_user {
    font-size: 1.5rem;
}

.icon-search {
    margin: 3px;
}

.icon-heart {
    margin: 3px;
}
</style>
<!-- Header -->
<nav class="navbar navbar-expand-lg back-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand" href="<?= Url::to(['site/add-cart']) ?>">
            <img class="" src="<?= $base_url ?>/template/img/logo2.png" style="width:8rem" ;height="8rem">
        </a>
        <div class="div">
            <button class="navbar-toggler text-color text-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="templatemo_main_nav" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-color"></i>
            </button>
        </div>
        <div class="align-self-center collapse navbar-collapse justify-content-lg-between mt-3"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul id="menu" class="nav navbar-nav d-flex justify-content-start mx-lg-auto">
                    <li class="dropdown">
                        <input id="check01" type="checkbox" name="menu" />
                        <a href="<?= Url::to(['site/store-man']) ?>" class="dropdown-toggle a-title"
                            data-toggle=""><?= \Yii::t('app', 'MAN') ?>
                            <b class="caret"></b></a>

                        <ul class="dropdown-menu mega-menu submenu" style="background-color: #edf2fc;">
                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header"><a href="<?= Url::to(['site/store-all-top-man']) ?>">ALL
                                            TOPS</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-tshirt-man']) ?>">T-Shirts</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-hoodies-man']) ?>">Hoodies & Sweaters</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-top-short-sleeves-man']) ?>">Shirts Short
                                            Sleeves</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-long-sleeves-man']) ?>">Shirts Long
                                            Sleeves</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-tanks-man']) ?>">TANK TOPS</a></li>

                                </ul>
                            </li>
                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header"><a href="<?= Url::to(['site/store-all-bottoms-man']) ?>">ALL
                                            BOTTOMS</a></li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-jean-man']) ?>">Jeans</a></li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-pants-trousers-man']) ?>">Pants &
                                            Trousers</a></li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-joggers-man']) ?>">Joggers</a></li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-short-pants-man']) ?>">Short Pants</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-sports-man']) ?>">Sport</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header"><a
                                            href="<?= Url::to(['site/store-all-accessories-man']) ?>">ALL
                                            ACCESSORIES</a></li>
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
                        <input id="check01" type="checkbox" name="menu" />
                        <a href="<?= Url::to(['site/store-women']) ?>" class="dropdown-toggle a-title"
                            data-toggle=""><?= \Yii::t('app', 'WOMEN') ?> <b class="caret"></b></a>

                        <ul class="dropdown-menu mega-menu submenu" style="background-color: #edf2fc;">
                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header"><a href="<?= Url::to(['site/store-all-top-woman']) ?>">ALL
                                            TOPS</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-tshirt-woman']) ?>">T-Shirts</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-dresses-jumpsuits-woman']) ?>">Dresses
                                            &
                                            Jumpsuits</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-hoodies-sweaters-woman']) ?>">Hoodies
                                            &
                                            Sweaters</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-top-shirts-tops-woman']) ?>">Shirts &
                                            Tops</a></li>
                                    <li><a href="<?= Url::to(['site/store-top-jackets-raincoats-woman']) ?>">Jackets
                                            &
                                            Raincoats</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header"><a
                                            href="<?= Url::to(['site/store-all-bottoms-woman']) ?>">BOTTOMS</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-pants-trousers-woman']) ?>">Pants &
                                            Trousers</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-jeans-woman']) ?>">Jeans</a></li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-joggers-woman']) ?>">Joggers</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-short-pants-woman']) ?>">Short
                                            Pants</a>
                                    </li>
                                    <li><a href="<?= Url::to(['site/store-bottoms-skirts-woman']) ?>">Skirts</a></li>
                                </ul>
                            </li>

                            <li class="mega-menu-column">
                                <ul>
                                    <li class="nav-header"><a
                                            href="<?= Url::to(['site/store-all-accessories-woman']) ?>">ALL
                                            ACCESSORIES</a></li>
                                    <li><a href="<?= Url::to(['site/store-accessories-headwear-woman']) ?>">Headwear</a>
                                    </li>
                                </ul>
                            </li>

                        </ul><!-- dropdown-menu -->

                    </li>
                    <!-- <li class="nav-item text-color">
                        <a class="link-brand" href="<?= Url::to(['site/store-women']) ?>">Women</a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="navbar1 align-self-center d-flex pt-3">
            <a class="nav-icon d-lg-inline icon-menu icon-search" href="#" data-bs-toggle="modal"
                data-bs-target="#templatemo_search">
                <i class="fa fa-fw fa-search mr-2 text-color"></i>
            </a>
            <?php 

            if(Yii::$app->user->isGuest){
                ?>
            <a class="nav-icon position-relative text-decoration-none pl-3 icon-heart" value="login"
                href="<?= Url::to(['site/login']) ?>">
                <i class="fa-regular fa-heart text-color mr-1 font_icon" style="font-size: 1.5rem;"></i>
                <span id="favortie-quantity"
                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $favoritestotal?></span>
            </a>
            <?php
            }else{
                ?>
            <a id="myFav" class="nav-icon position-relative text-decoration-none pl-3 icon-heart" value="login"
                href="<?= Url::to(['/site/favorites']) ?>">
                <i class="fa-regular fa-heart text-color mr-1 font_icon" style="font-size: 1.5rem;"></i>
                <span id="favortie-quantity"
                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $favoritestotal?></span>
            </a>
            <?php
            }
        ?>
            <?php
        if (Yii::$app->user->isGuest) {
        ?>
            <a class="nav-icon position-relative text-decoration-none pl-3" value="login"
                href="<?= Url::to(['/site/login']) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="1.5rem" class="bag-icon"
                    height="1.5rem">
                    <path
                        d="M21,6H18A6,6,0,0,0,6,6H3A3,3,0,0,0,0,9V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V9A3,3,0,0,0,21,6ZM12,2a4,4,0,0,1,4,4H8A4,4,0,0,1,12,2ZM22,19a3,3,0,0,1-3,3H5a3,3,0,0,1-3-3V9A1,1,0,0,1,3,8H6v2a1,1,0,0,0,2,0V8h8v2a1,1,0,0,0,2,0V8h3a1,1,0,0,1,1,1Z" />
                </svg>
                <span id="cart-quantity"
                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
            </a>
            <?php
        } else {
        ?>
            <a class="nav-icon position-relative text-decoration-none bag-shop pl-3"
                href="<?= Url::to(['site/cart']) ?>">
                <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="1.5rem" class="bag-icon"
                    height="1.5rem">
                    <path
                        d="M21,6H18A6,6,0,0,0,6,6H3A3,3,0,0,0,0,9V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V9A3,3,0,0,0,21,6ZM12,2a4,4,0,0,1,4,4H8A4,4,0,0,1,12,2ZM22,19a3,3,0,0,1-3,3H5a3,3,0,0,1-3-3V9A1,1,0,0,1,3,8H6v2a1,1,0,0,0,2,0V8h8v2a1,1,0,0,0,2,0V8h3a1,1,0,0,1,1,1Z" />
                </svg>
                <span id="cart-quantity"
                    class="position-absolute top-0 left-100 translate-middle badge rounded-pill badge badge-danger"><?= $totalCart ?></span>
            </a>
            <?php
        }
        
        ?>
            <div class="languages">
                <?php
      $language = Yii::$app->language;
      if ($language == 'en-US') { ?>
                <form id="lang-form" action="/Zay/admin/default/language" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf"
                        value="V53vWUVNd-NefwfinKxGFU3IetycNr1mfZv2msWI25sa8JsOdBcbgTwSctHM9QpQHbsf6utX9ioYyJncitCjrw==">
                    <select class="select-lang" name="language" id="lang">
                        <option value="en-US" selected>English</option>
                        <option value="kh-KM">Khmer</option>
                    </select>
                </form>
                <?php } else { ?>
                <form id="lang-form" action="/Zay/admin/default/language" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_csrf"
                        value="V53vWUVNd-NefwfinKxGFU3IetycNr1mfZv2msWI25sa8JsOdBcbgTwSctHM9QpQHbsf6utX9ioYyJncitCjrw==">
                    <select class="select-lang" name="language">
                        <option value="en-US">English</option>
                        <option value="kh-KM" selected>Khmer</option>
                    </select>
                </form>
                <?php }
      ?>
            </div>
            <?php
        if (Yii::$app->user->isGuest) {
        ?>

            <a style="cursor:poiter;text-decoration:none;padding:0 3px;color:#000;font-weight: 700;font-size:1.2rem"
                href="<?= Url::to(['/site/login']) ?>" class="pl-3">Login<i class="fas fa-user"
                    style="padding:0 3px;color:#000"></i></a>
            <?php
        } else {
        ?>
            <?php $menuItems[] = ['label' => ''] ?>
            <div class="btn-group pl-3">
                <div class="dropdown">
                    <a class="noHover" href="#" id="dropdownMenuButton" data-toggle="dropdown" data-bs-toggle="dropdown"
                        data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                        <?php 
                    if($model->image_url == null){
                        ?>
                        <img class="rounded-circle mr-3"
                            src="<?= $base_url ?>/uploads/orionthemes-placeholder-image-1.png ?> ?>"
                            style="width:40px;height:40px;object-fit: cover;" alt="profile">
                        <?php }else{?>
                        <img class="rounded-circle mr-3" src="<?= $base_url ?>/profile/uploads/<?= $model->image_url ?>"
                            style="width:40px;height:40px;object-fit: cover;" alt="profile">
                        <?php }?>
                        <!-- <i class="fas fa-user" style="font-size: 1.5rem; color:#000"></i> -->
                    </a>
                    <div class=" dropdown-menu back-light" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item d-flex justify-content-between" href="<?= Url::to(['site/profile']) ?>">
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
                        <a class="dropdown-item text-dark" href="<?= Url::to(['site/view-booking-history']) ?>">My Booking</a>
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