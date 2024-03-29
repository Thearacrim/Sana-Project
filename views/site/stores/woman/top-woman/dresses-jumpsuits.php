<?php

/* @var $this yii\web\View */

use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = 'WOMAN';
$this->params['breadcrumbs'][] = $this->title;

$minprice = Yii::$app->request->get('minprice') ?? 5;
$maxprice = Yii::$app->request->get('maxprice') ?? 50;

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
                        <input type="number" class="input-min" value="<?= $minprice ?>">
                    </div>
                    <div class="separator">To</div>
                    <div class="field">
                        <span>$</span>
                        <input type="number" class="input-max" value="<?= $maxprice ?>">
                    </div>
                </div>
                <div class="slider">
                    <div class="progress"></div>
                </div>
                <div class="range-input">
                    <input type="range" id="min" name="min_price" class="range-min" min="0" max="100" value="<?= $minprice ?>" step="1">
                    <input type="range" id="max" name="max_price" class="range-min" min="0" max="100" value="<?= $maxprice ?>" step="1">
                </div>
            </div>

        </div>
        <!-- cart-section -->
        <div class="col-lg-9">
            <div class="title-man">WOMAN DRESSES && JUMPSUITS</div>
            <hr>
            <div class="side-wrapper stories">
                <!-- <div class="side-title">STORIES</div> -->
                <div class="user">
                    <a href="<?= Url::to(['site/store-top-tshirt-woman']) ?>">
                        <img src="https://cdn.shopify.com/s/files/1/0082/0356/7215/products/cozy-lady-t-shirt-790-moi-outfit-873665_360x.jpg?v=1679367361"
                            alt="" class="user-img">
                    </a>
                    <div class="username">T-Shirt
                    </div>
                </div>
                <div class="user">
                    <a href="<?= Url::to(['site/store-top-hoodies-sweaters-woman']) ?>">
                        <img src="https://cdn.shopify.com/s/files/1/0082/0356/7215/products/back-logo-printed-unisex-hoodie-3990-458592_360x.jpg?v=1631649731"
                            alt="" class="user-img">
                    </a>
                    <div class="username">Hoodies && Sweaters
                    </div>

                </div>
                <div class="user">
                    <a href="<?= Url::to(['site/store-top-shirts-tops-woman']) ?>">
                        <img src="https://cdn.shopify.com/s/files/1/0082/0356/7215/products/puff-sleeve-lady-short-sleeve-shirt-1750-974588_360x.jpg?v=1631651656"
                            alt="" class="user-img">
                    </a>
                    <div class="username">Shirts & Tops
                    </div>

                </div>
                <div class="user">
                    <a href="<?= Url::to(['site/store-top-jackets-raincoats-woman']) ?>">
                        <img src="https://cdn.shopify.com/s/files/1/0082/0356/7215/products/basic-lady-icon-denim-jacket-1890-361255_360x.jpg?v=1631649793"
                            alt="" class="user-img">
                    </a>
                    <div class="username">Jackets & Raincoats
                    </div>

                </div>
            </div>
            <div class="row Sort">
                <div class="col-md-6 Sort-section">
                    <div class="d-flex">
                        <span class="sort-item">Sort by</span>

                        <?= Html::dropDownList(
                            'dateFilter',
                            $sort,
                            $drowdown,
                            ['class' => 'form-select dateFilter']
                        ) ?>
                    </div>
                </div>
            </div>
            <!-- section-cart -->
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '/site/stores/product_cart',
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
$add_fav_url = Url::to(['site/favorites']);
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
    $("select[name='dateFilter']").change(function(){
        var value = $(this).val();
        var url = new URL(window.location.href);
        url.searchParams.set('sort',value);
        window.location.href = url.href;
    });

    

JS;

$this->registerJs($script);


?>