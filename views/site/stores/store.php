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
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4 text-color">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none text-color" href="#">
                        Gender
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none text-color" href="<?= Url::to(['site/store-man']) ?>">Men</a></li>
                        <li><a class="text-decoration-none text-color" href="<?= Url::to(['site/store-women']) ?>">Women</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed text-color d-flex justify-content-between h3 text-decoration-none" href="#">
                        Sale
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none text-color" href="<?= Url::to(['site/store-sport']) ?>">Sport</a></li>
                        <li><a class="text-decoration-none text-color" href="<?= Url::to(['site/store-gym']) ?>">Gym</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex text-color justify-content-between h3 text-decoration-none" href="#">
                        Product
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none text-color text-color" href="<?= Url::to(['site/store-bag']) ?>">Bag</a></li>
                        <li><a class="text-decoration-none text-color text-color" href="<?= Url::to(['site/store-man']) ?>">Sweather</a></li>
                        <li><a class="text-decoration-none text-color text-color" href="<?= Url::to(['site/store-man']) ?>">Sunglass</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- cart-section -->
        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-decoration-none text-color mr-3" href="#">All</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-decoration-none text-color mr-3" href="<?= Url::to(['site/store-man']) ?>">Men's</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-decoration-none text-color" href="<?= Url::to(['site/store-women']) ?>">Women's</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control">
                            <option class="text-color">Featured</option>
                            <option class="text-color">A to Z</option>
                            <option class="text-color">Item</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- section-cart -->
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
            <div class="text-center">
                <button id="load_more" class="btn btn-outline-primary rounded-0">Load More</button>
            </div>
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