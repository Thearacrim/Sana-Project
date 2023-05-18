<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = $products->status;
$this->params['breadcrumbs'][] = $this->title;

$base_url = Yii::getAlias("@web");
$discount = Yii::$app->db->createCommand("SELECT
        discount
    FROM
        `coupon` 
    WHERE
    CURDATE() < expire_date
            ")
    ->queryScalar();
$discountCal = $products->price * ($discount / 100);

?>
<?php
Yii::$app->params['og_title']['content'] = $products->status;
Yii::$app->params['og_description']['content'] = $products->description;
Yii::$app->params['og_url']['content'] = '/new/url';
Yii::$app->params['og_image']['content'] = $products->image_url;
?>
<!-- Open Content -->
<!-- <div class="loader">
</div> -->
<div class="loading">
    <section class="back-light">
        <div class="container pb-5">
            <div class="row product-item" data-key="<?= $products->id ?>">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <?php if ($discount) {
                        ?>
                        <div class="ribbon-wrapper">
                            <div class="ribbon-tag">Hot Deals</div>
                        </div>
                        <?php
                        } else {
                        } ?>
                        <img class="card-img" src="<?= $base_url ?>/<?= $products->image_url ?>" alt="Card image cap"
                            id="product-detail">
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->
                        <!--Start Carousel Wrapper-->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                            data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <?php foreach ($relateImage as $key => $modelImage) {?>
                                        <div class="col-4">

                                            <a href="#">
                                                <img class="card-img"
                                                    src="<?= $base_url."/".$modelImage->image_relate?>"
                                                    alt="Product Image 1">
                                            </a>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--/.First slide-->

                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php foreach ($relateImage as $key => $modelImage) {?>
                                        <div class="col-4">

                                            <a href="#">
                                                <img class="card-img"
                                                    src="<?= $base_url."/".$modelImage->image_relate?>"
                                                    alt="Product Image 1">
                                            </a>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--/.Second slide-->

                                <!--Third slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php foreach ($relateImage as $key => $modelImage) {?>
                                        <div class="col-4">

                                            <a href="#">
                                                <img class="card-img"
                                                    src="<?= $base_url."/".$modelImage->image_relate?>"
                                                    alt="Product Image 1">
                                            </a>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <!--/.Third slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                        <!--End Carousel Wrapper-->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 col-sm-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <span class="h2"><?= $products->status ?></span>
                            <?php
                            if ($discount) {
                            ?>
                            <h6 class="price-single h2"
                                style="text-decoration: line-through; font-size:1.2rem; font-weight:700;">
                                $<?= $products->price ?></h6>
                            <?php
                            } else {
                            ?>
                            <h6 class="price-single h2" style="font-size:1.2rem; font-weight:700;">
                                $<?= $products->price ?></h6>
                            <?php
                            }
                            ?>
                            <?php if ($discount) {
                            ?>
                            <span
                                style="font-size:3rem; font-weight:700;">$<?= $products->price - $discountCal ?></span>
                            <?php
                            } else {
                            } ?>
                            <p class="py-2">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6 class="text-color">Brand:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>Easy Wear</strong></p>
                                </li>
                            </ul>
                            <h6>Description:</h6>
                            <p><?= $products->description ?></p>

                        </div>
                        <div class="swatches d-flex pr-5 pl-5 justify-content-between">
                            <div id="variant-size" class="swatch clearfix" data-option-index="0">
                                <input type="hidden" name="search_param" value="1" id="variantSize">
                                <div class="header">Size</div>
                                <div data-value="1" class="swatch-element plain m available">
                                    <input id="swatch-0-m" type="radio" name="option-0" value="M" checked />
                                    <label for="swatch-0-m">
                                        M
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                    </label>
                                </div>
                                <div data-value="2" class="swatch-element plain l available">
                                    <input id="swatch-0-l" type="radio" name="option-0" value="L" />
                                    <label for="swatch-0-l">
                                        L
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                    </label>
                                </div>
                                <div data-value="3" class="swatch-element plain xl available">
                                    <input id="swatch-0-xl" type="radio" name="option-0" value="XL" />
                                    <label for="swatch-0-xl">
                                        XL
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                    </label>
                                </div>
                                <div data-value="4" class="swatch-element plain xxl available">
                                    <input id="swatch-0-xxl" type="radio" name="option-0" value="XXL" />
                                    <label for="swatch-0-xxl">
                                        XXL
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                    </label>
                                </div>
                            </div>
                            <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                <input type="hidden" name="search_param" value="1" id="variantColor">
                                <div class="header">Color</div>
                                <div data-value="1" class="swatch-element color blue available">
                                    <div class="tooltip">Blue</div>
                                    <input quickbeam="color" id="swatch-1-blue" type="radio" name="option-1" value="1"
                                        checked />
                                    <label for="swatch-1-blue" style="border-color: blue;">
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                        <span style="background-color: blue;"></span>
                                    </label>
                                </div>
                                <div data-value="2" class="swatch-element color red available">
                                    <div class="tooltip">Red</div>
                                    <input quickbeam="color" id="swatch-1-red" type="radio" name="option-1" value="2" />
                                    <label for="swatch-1-red" style="border-color: red;">
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                        <span style="background-color: red;"></span>
                                    </label>
                                </div>
                                <div data-value="3" class="swatch-element color yellow available">
                                    <div class="tooltip">Yellow</div>
                                    <input quickbeam="color" id="swatch-1-yellow" type="radio" name="option-1"
                                        value="3" />
                                    <label for="swatch-1-yellow" style="border-color: yellow;">
                                        <img class="crossed-out"
                                            src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                        <span style="background-color: yellow;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="btn-qty pr-5 pl-5 pb-5">
                            <?php if (Yii::$app->user->isGuest) { ?>
                            <a class="btn btn-primary btn-sm btn-buy-now rounded-0"
                                href="<?= Url::to(['/site/login']) ?>" value="<?= Url::to(['/site/login']) ?>"><i
                                    class="fa-solid fa-cart-shopping"></i> Buy
                                Now</a>
                            <a class="btn btn-primary btn-sm btn-buy-now rounded-0"
                                href="<?= Url::to(['/site/login']) ?>" value="<?= Url::to(['/site/login']) ?>"><i
                                    class="fa-solid fa-cart-shopping"></i> Add To Cart</a>
                            <?php } else { ?>
                            <div class="row">
                                <div class="col-lg-6 col ">
                                    <a href="#" class="btn btn-primary btn-sm btn-buy-now rounded-0"><i
                                            class="fa-solid fa-cart-shopping"></i> Buy Now</a>
                                </div>
                                <div class="col-lg-6 col text-right">
                                    <a class="btn btn-primary btn-sm btn-add-to-cart rounded-0"><i
                                            class="fa-solid fa-cart-shopping"></i> Add To Cart</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->
    <!-- Start Article -->
    <section class=" py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4 class="text-color">You might also like</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <!-- <div class="item"> -->
            <div class="owl-carousel owl-theme">
                <?php
                foreach ($relatedProduct as $key => $model) {
                ?>
                <?php

                    $base_url = Yii::getAlias("@web");
                    /*@var \yii\data\ActiveDataProvider $dataProvider*/

                    ?>

                <div class="card mb-4 product-wap rounded-0">
                    <div class="card rounded-0">
                        <?php if ($discount) {
                            ?>
                        <div class="ribbon-wrapper">
                            <div class="ribbon-tag">Hot Deals</div>
                        </div>
                        <?php
                            } else {
                            } ?>
                        <img class="card-img rounded-0 image-size" src="<?= $base_url . '/' . $model->image_url ?>" />
                        <div
                            class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <li>
                                    <a class="btn btn-success text-white" href="#"><i class="far fa-heart"></i></a>
                                </li>
                                <li>
                                    <a class="btn btn-success text-white mt-2"
                                        href="<?= Url::to(['store-single', 'id' => $model->id]) ?>"><i
                                            class="far fa-eye"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                }

                ?>
                <!-- </div> -->
            </div>
        </div>
    </section>
</div>

<!-- End Article -->

<?php
$add_cart_url = Url::to(['site/store-single', 'id' => $model->id]);

$script = <<< JS
            $(document).on("click",".trigggerModal",function(){
                  $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
                  });
            $(function(){
                $('#variant-color > div').click(function(){
                    var val = $(this).attr('data-value');
                    $('#variantColor').attr('name', val);
                    $('#variantColor').val(val);
                });
            });
            $(function(){
                $('#variant-size > div').click(function(){
                    var val = $(this).attr('data-value');
                    $('#variantSize').attr('name', val);
                    $('#variantSize').val(val);
                });
            });
            setTimeout(function(){
                $('.loader').css('display','none');
            }, 1300);

            var base_url = "$base_url";

            $(".btn-add-to-cart").click(function(e){
                e.preventDefault();
                var id = $(this).closest(".product-item").data("key");
                var colorId = $("#variantColor").val();
                var sizeId = $("#variantSize").val();
                console.log(sizeId);
                console.log(colorId);
                $.ajax({
                    url: '$add_cart_url' ,
                    method: 'POST',
                    data: {
                        id: id,
                        colorId : colorId,
                        sizeId : sizeId,
                        action: 'btn-add-to-cart'
                    },
                    success: function(res){
                        var data = JSON.parse(res);
                        console.log(data);
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
            $(".btn-buy-now").click(function(){
                var id = $(this).closest(".product-item").data("key");
                var colorId = $("#variantColor").val();
                var sizeId = $("#variantSize").val();
                console.log(sizeId);
                console.log(colorId);
                $.ajax({
                    url: '$add_cart_url' ,
                    method: 'POST',
                    data: {
                        id: id,
                        colorId : colorId,
                        sizeId : sizeId,
                        action:'btn-buy-now'
                    },
                    success: function(res){
                        var data = JSON.parse(res);
                        console.log(data);
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

             var owl = $('.owl-carousel')
            owl.owlCarousel({
            loop:true,
            stagePadding: 50,
            autoplay:true,
            autoplayTimeout:3000,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
        if ($(".back-dark")[0]){
            $(".loader").css("background-color","#082032");
        }else{
            $(".loader").css("background-color","#edf2fc");
        }
        JS;
$this->registerJs($script);

?>