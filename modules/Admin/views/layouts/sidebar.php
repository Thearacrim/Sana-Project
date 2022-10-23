<?php

use yii\helpers\Url;

$base_url = Yii::getAlias("@web");
Yii::$app->setHomeUrl(Yii::getAlias("@web/index.php?r=admin/default"));
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= Yii::$app->homeUrl ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Zay Admin <sup>+</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= Yii::$app->homeUrl ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsed" aria-expanded="false" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span><?= \Yii::t('app', 'home') ?></span>
    </a>
    <div id="collapsed" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Element Components:</h6>
        <a class="collapse-item" href="<?= Url::to(['/admin/banner']) ?>"><?= \Yii::t('app', 'banner') ?></a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?= Url::to(['/admin/product']) ?>">
      <i class="fas fa-balance-scale-right"></i>
      <span><?= \Yii::t('app', 'product') ?></span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?= Url::to(['/admin/order']) ?>">
      <i class="fas fa-book"></i>
      <span><?= \Yii::t('app', 'order') ?></span></a>
  </li>
  <!-- <li class="nav-item active">
    <a class="nav-link" href="<?= Url::to(['/admin/order-item']) ?>">
      <i class="fas fa-credit-card"></i>
      <span><?= \Yii::t('app', 'order item') ?></span></a>
  </li> -->

  <!-- Divider -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span><?= \Yii::t('app', 'report') ?></span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Managements:</h6>
        <a class="collapse-item" href="<?= Url::to(['/admin/report']) ?>"><?= \Yii::t('app', 'product rank') ?></a>
        <a class="collapse-item" href="<?= Url::to(['/admin/coupon']) ?>"><?= \Yii::t('app', 'coupon') ?></a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>