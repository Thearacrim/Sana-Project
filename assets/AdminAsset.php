<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
        'backend/css/sb-admin-2.min.css',
        'backend/css/custom.css',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        'backend/flatpickr/flatpickr.min.css',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css',
        'https://pro.fontawesome.com/releases/v5.10.0/css/all.css',
        // 'href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css',
        'backend/css/upload_image.css'
    ];
    public $js = [
        'backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'backend/vendor/jquery-easing/jquery.easing.min.js',
        'backend/js/sb-admin-2.min.js',
        'backend/vendor/chart.js/Chart.min.js',
        'backend/vendor/jquery-easing/jquery.easing.min.js',
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
        'backend/flatpickr/flatpickr.min.js',
        'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
        '//cdn.jsdelivr.net/npm/sweetalert2@11',
        'backend/js/overiddingAlert.js',
        'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
