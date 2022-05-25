<?php

/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'Store';
$this->params['breadcrumbs'][] = $this->title;

$base_url = Yii::getAlias("@web");

?>

<!-- Start Content -->
<!-- <div class="loader">
</div> -->
<div class="container loading py-5">
    <!-- cart-section -->
    <div class="row">
        <div class="col-md-6">
            <ul class="list-inline shop-top-menu pb-3 pt-1">
                <li class="list-inline-item">
                    <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                </li>
                <li class="list-inline-item">
                    <a class="h3 text-dark text-decoration-none mr-3" href="<?= Url::to(['site/store-man']) ?>">Men's</a>
                </li>
                <li class="list-inline-item">
                    <a class="h3 text-dark text-decoration-none" href="<?= Url::to(['site/store-women']) ?>">Women's</a>
                </li>
            </ul>
        </div>
        <div class="col-md-6 pb-4">
            <div class="d-flex">
                <select class="form-control">
                    <option>Featured</option>
                    <option>A to Z</option>
                    <option>Item</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Result searching -->
    <h5 class="text-center text-secondary pb-5 pt-5">Result for "<span style="font-weight:600"><?php print_r(Yii::$app->request->get('ProductSearch')['title']);
                                                                                                ?></span>"</h5>
    <!-- section-cart -->
    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'product_cart_search',
        'summary' => '<b>{begin}</b>-<b>{end}</b> of <b>{totalCount}</b>.',
        'itemOptions' => [
            // 'tag' => false
            'class' => "col-lg-3 col-md-4 col-sm-4 product-item"
        ],
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last',
            'class' => LinkPager::class,
        ],
        'layout' => '
        {summary}
                    <div class="row pt-5">
                        {items}
                    </div>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            {pager}
                        </div>
                    </div>
            
                '
    ]) ?>
</div>
<!-- Start Brands -->
<section class="back-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1 text-color">Our Brands</h1>
                <?php
                Modal::begin([
                    'title' => 'Login',
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
                echo "<div id='modalContent'></div>";
                Modal::end();
                ?>
                <p class="text-color">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    Lorem ipsum dolor sit amet.
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-light fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End First slide-->


                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_01.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_02.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_03.png" alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img" src="<?= $base_url ?>/template/img/brand_04.png" alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Third slide-->

                            </div>
                            <!--End Slides-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-light fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Brands-->