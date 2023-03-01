<?php

/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'T-SHIRT';
$this->params['breadcrumbs'][] = $this->title;

$base_url = Yii::getAlias("@web");
?>

<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <?php
        if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
        <?php elseif (Yii::$app->session->hasFlash('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
        <?php endif; ?>

        <div class="col-lg-3">
            <div class="wrapper">
                <header>
                    <h2>Price Range</h2>
                </header>
                <div class="price-input">
                    <div class="field">
                        <span>$</span>
                        <input type="number" class="input-min" value="0">
                    </div>
                    <div class="separator">To</div>
                    <div class="field">
                        <span>$</span>
                        <input type="number" class="input-max" value="230">
                    </div>
                </div>
                <div class="slider">
                    <div class="progress"></div>
                </div>
                <div class="range-input">
                    <input type="range" class="range-min" min="0" max="300" value="0" step="1">
                    <input type="range" class="range-max" min="0" max="300" value="233" step="1">
                </div>
            </div>
        </div>
        <!-- cart-section -->
        <div class="col-lg-9">
            <div class="title-man">WOMAN'S T-SHIRT</div>
            <hr>
            <div class="side-wrapper stories">
                <!-- <div class="side-title">STORIES</div> -->
                <div class="user">
                    <img src="https://images.unsplash.com/photo-1618453292459-53424b66bb6a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=464&q=80"
                        alt="" class="user-img">
                    <div class="username">ALL TOPS
                    </div>
                </div>
                <div class="user">
                    <img src="https://cdn.shopify.com/s/files/1/0082/0356/7215/products/logo-embroidered-men-track-pants-1990-moi-outfit-631797.jpg?v=1673308814"
                        alt="" class="user-img">
                    <div class="username">ALL BOTTOME
                    </div>
                </div>
                <div class="user">
                    <img src="https://cdn.shopify.com/s/files/1/0082/0356/7215/products/cuff-logo-embroidered-quarter-socks-3-pairs-890-moi-outfit-995871.jpg?v=1662791823"
                        alt="" class="user-img">
                    <div class="username">ALL ACCESSORIES
                    </div>
                </div>
            </div>
            <div class="row Sort">
                <div class="col-md-6 Sort-section">
                    <div class="d-flex">
                        <span class="sort-item">Sort by</span>

                        <select class="form-select" aria-label=".form-select-lg example" style="border-radius: 0px;">
                            <option>Featured</option>
                            <option>Date,new to old</option>
                            <option>Date,old to new</option>
                            <option>A to Z</option>
                            <option>Z to A</option>
                            <option>Price low to high</option>
                            <option>Price high to low</option>
                        </select>

                    </div>
                </div>
            </div>
            <!-- section-cart -->
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => 'product_cart',
                'itemOptions' => [
                    // 'tag' => false
                    'class' => "col-md-4 col-6 product-item"
                ],
                'pager' => [
                    'firstPageLabel' => 'Frist',
                    'lastPageLabel' => 'Last',
                    'maxButtonCount' => 3,
                    'class' => LinkPager::class,
                ],
                'layout' => '
                    <div class="row">
                    <div class="col-lg-6">
                        {summary}
                    </div>
                    <div class="col-lg-6 text-center">
                        {pager}
                    </div>
                        {items}
                        {pager}
                    </div>
            
                '
            ]) ?>
            <!-- <div class="text-center">
                <button id="load_more" class="btn btn-outline-primary rounded-0 text-color">Load More</button>
            </div> -->
        </div>
        <!-- End Cart -->
    </div>
    <!-- End Content -->

</div>
<!-- Start Brands -->
<section class="back-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1 text-color">Our Brands</h1>
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
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example"
                            data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_01.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_02.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_03.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_04.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End First slide-->


                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_01.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_02.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_03.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_04.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_01.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_02.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_03.png"
                                                    alt="Brand Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class="img-fluid brand-img"
                                                    src="<?= $base_url ?>/template/img/brand_04.png"
                                                    alt="Brand Logo"></a>
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

<?php
$add_cart_url = Url::to(['site/add-cart']);
$script = <<<JS
    var base_url = "$base_url";
    $(".btn-add-to-cart").click(function(e){
        e.preventDefault();
        var id = $(this).closest(".product-item").data("key")
        $.ajax({
            url: "$add_cart_url" ,
            method: 'POST',
            data: {
                id: id,
            },
            success: function(res){
                var data = JSON.parse(res);
                if(data['status'] == 'success'){
                    $("#cart-quantity").text(data['totalCart']);
                }else{
                    alert(data['message']);
                }
            },
            error: function(err){
                console.log(err);
            }
        });


    });
    $(document).ready(function () {
            $(".block").slice(0, 12).show();
            if ($(".block:hidden").length != 0) {
                $("#load_more").show();    
            }
            $("#load_more").on("click", function (e) {
                e.preventDefault();
                $(".block:hidden").slice(0, 12).slideDown();
                if ($(".block:hidden").length == 0) {
                    $("#load_more").text("No More to view")
                        .fadOut("slow");
                }
            });
        })

JS;

$this->registerJs($script);


?>