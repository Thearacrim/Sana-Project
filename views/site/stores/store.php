<?php

/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\widgets\ListView;
use sjaakp\loadmore\LoadMorePager;

$this->title = 'Store';
$this->params['breadcrumbs'][] = $this->title;

$base_url = Yii::getAlias("@web");

?>
<?php
Yii::$app->params['og_title']['content'] = $model->status;
Yii::$app->params['og_description']['content'] = $model->description;
Yii::$app->params['og_url']['content'] = '/new/url';
Yii::$app->params['og_image']['content'] = $model->image_url;
?>

<!-- Start Content -->
<?= $this->render("banner_men", ['base_url' => $base_url]) ?>
<div class="container py-5">

    <!-- Brand Collection -->
    <div class="row p-5">
        <div class="col-lg-4" style="margin: auto;">
            <hr>
        </div>
        <div class="col-lg-4 text-center" style="padding = 1rem">
            <h3 class="Collection-brand">New Collection</h3>
        </div>
        <div class="col-lg-4" style="margin: auto">
            <hr>
        </div>
    </div>
    <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => 'product_cart',
                'itemOptions' => [
                    'class' => "col-lg-4 col-md-4 col-6 product-item block"
                ],
                'layout' => '
                    <div class="row">
                        {items}
                    </div>
                '
            ]) ?>
    <!-- <div class="text-center">
                <button id="load_more" class="btn btn-outline-primary rounded-0">Load More</button>
            </div> -->
    <div class="row p-5">
        <div class="col-lg-3" style="margin: auto;">
            <hr>
        </div>
        <div class="col-lg-6 text-center" style="padding=1rem">
            <h3 class="Collection-brand">THIS WEEK'S HIGHLIGHTS</h3>
        </div>
        <div class="col-lg-3" style="margin:auto">
            <hr>
        </div>
    </div>
    <div class="row">
        <a href="#" class="columnCollect col-lg-6" id="zoomIn1">
            <figure><img
                    src="https://cdn.shopify.com/s/files/1/0082/0356/7215/files/banner_men_shirts_1080x800-min_720x.jpg?v=1614301857">
            </figure>
        </a>
        <a href="#" class="columnCollect col-lg-6" id="zoomIn1">
            <figure><img
                    src="https://cdn.shopify.com/s/files/1/0082/0356/7215/files/banner_men_jeans_1080x800-min_720x.jpg?v=1614301857">
            </figure>
        </a>
    </div>
    <div class="row p-5">
        <div class="col-lg-4" style="margin: auto;">
            <hr>
        </div>
        <div class="col-lg-4 text-center" style="padding=1rem">
            <h3 class="Collection-brand">BEST SELLERS</h3>
        </div>
        <div class="col-lg-4" style="margin: auto">
            <hr>
        </div>
    </div>
    <?php echo ListView::widget([
                'dataProvider' => $dataProvider1,
                'itemView' => 'product_cart',
                'itemOptions' => [
                    'class' => "col-lg-4 col-md-4 col-6 product-item"
                ],
                'layout' => '
                    <div class="row">
                        {items}
                    </div>
                '
            ]) ?>


    <?= $this->render("banner_women", ['base_url' => $base_url]) ?>
</div>
<!-- End Cart -->
<!-- End Content -->
<!-- Start Brands -->
<section class="back-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="text-color">Our Brands</h1>
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
                                <img src="" alt="">
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