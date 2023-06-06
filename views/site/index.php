<?php

/** @var yii\web\View $this */

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Request;

$this->title = 'My Yii Application';
$base_url = Yii::getAlias("@web");
?>
<?php
Yii::$app->params['og_title']['content'] = 'Set title';
Yii::$app->params['og_description']['content'] = 'custom desc';
Yii::$app->params['og_url']['content'] = '/new/url';
Yii::$app->params['og_image']['content'] = 'image.jpg';
?>
<?php (new Request)->getBaseUrl();
?>
<!-- Start Categories of The Month -->
<?php
$payment = Yii::$app->session->hasFlash('success') ? 1 : 0;
?>
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="text-color"><?= \Yii::t('app', 'categories of The Month');
                                    ?></h1>
            <p class="text-color">
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 p-5 mt-3">
            <div class="text-center">
                <a href="<?= Url::to(['site/store-watch']) ?>"><img src="<?= $base_url ?>/<?// $watch->image_url ?>"
                        class="rounded-circle border categories_img"></a>
            </div>
            <h5 class="text-center mt-3 mb-3 text-color"><?= \Yii::t('app', 'watches') ?></h5>
            <p class="text-center"><a href="<?// Url::to(['site/store-watch']) ?>" class=" btn btn-success">Go Shop</a>
            </p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 p-5 mt-3">
            <div class="text-center">
            </div>
            <h2 class="h5 text-center mt-3 mb-3 text-color"><?= \Yii::t('app', 'shoes') ?></h2>
            <p class="text-center"><a href="<?= Url::to(['site/store-shoes']) ?>" class=" btn btn-success">Go Shop</a>
            </p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 p-5 mt-3">s
            <h2 class="h5 text-center mt-3 mb-3 text-color"><?= \Yii::t('app', 'accessories') ?></h2>
            <p class="text-center"><a href="<?= Url::to(['site/store-glasses']) ?>" class="btn btn-success">Go Shop</a>
            </p>
        </div>
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="back-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="text-color"><?= \Yii::t('app', 'featured product') ?></h1>
                <p class="text-color">
                    Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident.
                </p>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="<?= Url::to(['site/store']) ?>">
                        <img src="<?= $base_url ?>/template/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body back-light">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                            </li>
                            <li class="text-muted text-right text-color">$240.00</li>
                        </ul>
                        <a href="<?= Url::to(['site/store']) ?>" class="h2 text-decoration-none text-color">Gym
                            Weight</a>
                        <p class="card-text text-color">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt in culpa qui officia
                            deserunt.
                        </p>
                        <p class="text-muted text-color">Reviews (24)</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="<?= Url::to(['site/store']) ?>">
                        <img src="<?= $base_url ?>/template/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body back-light">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                            </li>
                            <li class="text-muted text-right text-color">$480.00</li>
                        </ul>
                        <a href="<?= Url::to(['site/store']) ?>" class="h2 text-decoration-none text-color">Cloud Nike
                            Shoes</a>
                        <p class="card-text text-color">
                            Aenean gravida dignissim finibus. Nullam ipsum diam, posuere vitae pharetra sed, commodo
                            ullamcorper.
                        </p>
                        <p class="text-muted text-color">Reviews (48)</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="<?= Url::to(['site/store']) ?>">
                        <img src="<?= $base_url ?>/template/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body back-light">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                            </li>
                            <li class="text-muted text-right text-color">$360.00</li>
                        </ul>
                        <a href="<?= Url::to(['site/store']) ?>" class="h2 text-decoration-none text-color">Summer
                            Addides Shoes</a>
                        <p class="card-text text-color">
                            Curabitur ac mi sit amet diam luctus porta. Phasellus pulvinar sagittis diam, et scelerisque
                            ipsum lobortis nec.
                        </p>
                        <p class="text-muted text-color">Reviews (74)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Featured Product -->

<?php
$script = <<< JS
    if($payment)
    {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        Toast.fire({
        icon: 'success',
        title: 'You purchas successfully'
        })
    }
    JS;
$this->registerJs($script);

?>