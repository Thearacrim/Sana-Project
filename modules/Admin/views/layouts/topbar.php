<?php $base_url = Yii::getAlias("@web");

use backend\models\Product;
use yii\helpers\Url;

?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light back-light topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Search -->
  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="button">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
  </form>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>
    <!-- Dropdown - Messages -->
    <input type="checkbox" class="checkbox" onclick="darkLight()" id="chk" />
    <label class="label" for="chk">
      <i class="fas fa-moon"></i>
      <i class="fas fa-sun"></i>
      <div class="ball"></div>
    </label>
    <div class="languages">
      <?php
      $language = Yii::$app->language;
      if ($language == 'en-US') { ?>
        <form id="lang-form" action="/Zay/admin/default/language" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_csrf" value="V53vWUVNd-NefwfinKxGFU3IetycNr1mfZv2msWI25sa8JsOdBcbgTwSctHM9QpQHbsf6utX9ioYyJncitCjrw==">
          <select class="select-lang" name="language" id="lang">
            <option value="en-US" selected>English</option>
            <option value="kh-KM">Khmer</option>
          </select>
        </form>
      <?php } else { ?>
        <form id="lang-form" action="/Zay/admin/default/language" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_csrf" value="V53vWUVNd-NefwfinKxGFU3IetycNr1mfZv2msWI25sa8JsOdBcbgTwSctHM9QpQHbsf6utX9ioYyJncitCjrw==">
          <select class="select-lang" name="language">
            <option value="en-US">English</option>
            <option value="kh-KM" selected>Khmer</option>
          </select>
        </form>
      <?php }
      ?>
    </div>

    <div class="topbar-divider d-none d-sm-block">

    </div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small text-uppercase"><?= Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name  ?></span>
        <img class="img-profile rounded-circle" src="<?= $base_url . "/profile/uploads/" . Yii::$app->user->identity->image_url ?>">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Settings
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
          Activity Log
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>

</nav>
<!-- End of Topbar -->
<?php
$base_url = Yii::getAlias('@web/index.php?r=admin/default');
$script = <<< JS
  $("form#lang-form").change(function () {
            var form = $(this);
            // submit form
            $.ajax({
                url: '$base_url/language',
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