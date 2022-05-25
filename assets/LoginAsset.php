<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class LoginAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'backend/vendor/fontawesome-free/css/all.min.css',
    'backend/css/sb-admin-2.min.css'
  ];
  public $js = [
    'backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'backend/vendor/jquery-easing/jquery.easing.min.js',
    'backend/js/sb-admin-2.min.js',
  ];
  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset',
  ];
}
