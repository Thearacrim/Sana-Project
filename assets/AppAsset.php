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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template/css/templatemo.css',
        'template/css/custom.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',
        'owlcarousel/assets/owl.carousel.min.css',
        'owlcarousel/assets/owl.theme.default.min.css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        'template/css/variant.css',
    ];
    public $js = [
        'template/js/jquery-migrate-1.2.1.min.js',
        'template/js/templatemo.js',
        'template/js/custom.js',
        'template/js/slick.min.js',
        'template/js/cart.js',
        'owlcarousel/owl.carousel.min.js',
        '//cdn.jsdelivr.net/npm/sweetalert2@11',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',
        'https://polyfill.io/v3/polyfill.min.js?features=default',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        'template/js/scrollfixed.js',
        'template/js/swup.js',
        'https://polyfill.io/v3/polyfill.min.js?features=default',
        'swup/dist/swup.min.js',
        'template/js/lang.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
