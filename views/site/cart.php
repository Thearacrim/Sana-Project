<?php

use backend\models\Cart;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$base_url = Yii::getAlias("@web");

?>
<?php
Yii::$app->params['og_title']['content'] = 'Set title';
Yii::$app->params['og_description']['content'] = 'custom desc';
Yii::$app->params['og_url']['content'] = '/new/url';
Yii::$app->params['og_image']['content'] = 'image.jpg';
?>
<div class="container">
    <div class="cart-main">
        <?php
        if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php elseif (Yii::$app->session->hasFlash('Error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= Yii::$app->session->getFlash('alert') ?>
            </div>
        <?php elseif (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <!-- <div class="loader">
                </div> -->
                <div class="loading">
                    <div class="card-header border">
                        <h2 class="text-color">Items</h2>
                    </div>
                    <div class="card-body border">
                        <?php
                        if (!$totalCart) {
                            echo "<span id ='available_item'>There are no items available</span>";
                        } else {
                            echo "<span id ='available_item'></span>";
                        }
                        ?>
                        <?php foreach ($relatedProduct as $key => $product) { ?>
                            <div class="sec-border row_item_<?= $product['cart_id'] ?> rounded-0 hover p-3">
                                <div class="row ">
                                    <div class="col-md-3 col-sm-3">
                                        <a href="<?= Url::to(['site/store-single?id=' . $product['id']]) ?>"><img src="<?= $base_url . '/frontend/' . $product['image_url'] ?>" style="width:110px"></a>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="status text-color"> <?= $product['status'] ?>
                                        </span><br>
                                        <div class="d-flex justify-content-start">
                                            <span class="price text-color" style="padding-top:10px;padding-right:10px"> $<?= $product['price'] ?></span>
                                            <?php if ($product['color'] == 'Blue') { ?>
                                                <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                                    <div data-value="1" class="swatch-element color blue available">
                                                        <div class="tooltip">Blue</div>
                                                        <input quickbeam="color" id="swatch-1-blue" name="option-1" value="1" checked />
                                                        <label for="swatch-1-blue" style="border-color: blue;">
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                            <span style="background-color: blue;"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } else if ($product['color'] == 'Yellow') { ?>
                                                <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                                    <div data-value="3" class="swatch-element color yellow available">
                                                        <div class="tooltip">Yellow</div>
                                                        <input quickbeam="color" id="swatch-1-yellow" name="option-1" value="3" />
                                                        <label for="swatch-1-yellow" style="border-color: yellow;">
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                            <span style="background-color: yellow;"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div id="variant-color" class="swatch clearfix" data-option-index="1">
                                                    <div data-value="2" class="swatch-element color red available">
                                                        <div class="tooltip">Red</div>
                                                        <input quickbeam="color" id="swatch-1-red" name="option-1" value="2" />
                                                        <label for="swatch-1-red" style="border-color: red;">
                                                            <img class="crossed-out" src="//cdn.shopify.com/s/files/1/1047/6452/t/1/assets/soldout.png?10994296540668815886" />
                                                            <span style="background-color: red;"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <span class="price">
                                            <ul class="list-inline">
                                                <li class="list-inline-item text-color">Size :
                                                    <input type="hidden" name="product-size" id="product-size" value="S">

                                                </li>
                                                <li class="list-inline-item"><span class="btn btn-dark btn-sm rounded-circle text-color"> <?= $product['size'] ?></span></li>
                                            </ul>
                                        </span>
                                        <?php echo Html::a(
                                            'Save for later',
                                            ['save', 'id' => $product['cart_id']],
                                            [
                                                'class' => 'btn btn-outline-warning btn-sm rounded-0 btn-save-for-later',
                                                'date-method' => 'POST', 'data-id' => $product['cart_id'], 'data-save' => $product['id']
                                            ]
                                        ) ?>
                                        <?php echo Html::a(
                                            'Remove',
                                            ['remove', 'id' => $product['cart_id']],
                                            [
                                                'class' => 'btn btn-outline-danger rounded-0 btn-sm btn-remove-item warning',
                                                'date-method' => 'POST', 'data-id' => $product['cart_id']
                                            ]
                                        ) ?>
                                    </div>
                                    <div class="qty col-lg-3 col-md-8 col-sm-12 center d-inline py-5">
                                        <span class="minus bg-dark spinner item-quantity" data-product_id="<?= $product['id'] ?>" data-id=<?= $product['cart_id'] ?>>-</span>
                                        <input type="number" min='1' id="item-quantity_<?= $product['cart_id'] ?>" class="count item-quantity" name="qty" value="<?= $product['quantity'] ?>">
                                        <span class="plus bg-dark spinner item-quantity" data-product_id="<?= $product['id'] ?>" data-id=<?= $product['cart_id'] ?>>+</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <br>
                    <div class="card-header border">
                        <h2 class="text-color">Save for later</h2>
                    </div>
                    <div class="card-body border" id="Save_later_list">
                        <?php foreach ($product_save_later as $key => $product) { ?>
                            <div class="sec-border rounded-0 hover p-3 row_item_<?= $product['id'] ?>">
                                <div class="row ">
                                    <div class="col-2">
                                        <a href="<?= Url::to(['site/store-single?id=' . $product['id']]) ?>"><img src="<?= $base_url . '/frontend/' . $product['image_url'] ?>" style="width:50px"></a>
                                    </div>
                                    <div class="col-6">
                                        <span class="status text-color"> <?= $product['status'] ?>
                                        </span><br>
                                        <div class="d-flex justify-content-start">
                                            <span class="price text-color" style="padding-top:10px;padding-right:10px"> $<?= $product['price'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <a class="btn btn-outline-secondary btn-sm rounded-0 btn-move-to-cart" data-save="<?= $product['id'] ?>" href="<?= Url::to(['site/store-single?id=' . $product['id']]) ?>">Move to cart</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-4 rounded price-section">
                <div class="card-header border mb-3">
                    <h2 class="text-color">Price Detail</h2>
                </div>
                <div class="card-body border">
                    <h4 class="text-color">Subtotal(<span id="amount-item"><?= $totalCart ?></span>): </h4>
                    <h4 class="text-color"><span style="font-size:2.5rem">$</span> <span id='amount-price' style="font-size:2.5rem"><?= $totalPrice ?></span></h4>
                    <hr>
                    <a href="<?= Url::to(['site/checkout']) ?>"><button class="btn btn-primary rounded-0 btn-lg w-100 mt-3">CheckOut</button></a>
                </div>
            </div><br>
        </div>
    </div>
    <div class="row text-left p-2 pb-3 d-flex justify-content-between">
        <h4>You might also like</h4>
        <a class="nav-link text-right link-danger" href="<?= Url::to(['site/add-cart']) ?>"><i class=" fas fa-plus"></i> More</a>
    </div>

    <!--Start Carousel Wrapper-->
    <!-- <div class=" item"> -->
    <div class="owl-carousel owl-theme">
        <?php
        foreach ($products as $key => $model) {
        ?>
            <?php

            // $base_url = Yii::getAlias("@web");
            /*@var \yii\data\ActiveDataProvider $dataProvider*/

            ?>

            <div class="card mb-4 product-wap rounded-0">
                <div class="card rounded-0">
                    <img class="card-img rounded-0 image-size" src="<?= $base_url . '/frontend/' . $model->image_url ?>" />
                    <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                        <ul class="list-unstyled">
                            <li>
                                <a class="btn btn-success text-white" href="<?= Url::to('store-single') ?>"><i class="far fa-heart"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-success text-white mt-2" href="<?= Url::to('store-single?id=' . $model->id) ?>"><i class="far fa-eye"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <a href="<?= Url::to('store-single') ?>" class="h3 text-decoration-none"><?= $model->status ?></a>
                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                        <li>M/L/X/XL</li>
                        <li class="pt-2">
                            <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                            <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                        </li>
                    </ul>
                    <ul class="list-unstyled d-flex justify-content-center mb-1">
                        <li>
                            <?=

                            $star_str = '';
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $model->rate) {
                                    echo ' <i class="text-warning fa fa-star"></i>';
                                } else {
                                    echo ' <i class="fas fa-star"></i>';
                                }
                            }

                            ?>
                        </li>
                    </ul>
                    <p class="text-center mb-0">$<?= $model->price ?></p>
                </div>
            </div>
        <?php
        }

        ?>
        <!-- </div> -->
    </div>
</div>
</div>
<?php
$change_quantity_url = Url::to(['site/change-quantity']);
$base_url = Yii::getAlias("@web");
$script = <<< JS
        const change_quantity_url = "$base_url";
        setTimeout(function(){
                $('.loader').css('display','none');
            }, 1000);
        // input spinner
         var owl = $('.owl-carousel')
            owl.owlCarousel({
            loop:true,
            stagePadding: 50,
            autoplay:true,
            autoplayTimeout:3000,
            margin:10,
            navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
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
        });

            $(document).ready(function(){
                $('.count').prop('disabled', true);
                $(document).on('click','.plus',function(){
                    var id = $(this).data("id");
                    var qty = parseInt($("#item-quantity_"+id).val()) + 1;
                    $("#item-quantity_"+id).val(qty);
                    var product_id = $(this).data("product_id");
                     $.ajax({
                            url: '$change_quantity_url',
                            method: 'POST',
                            data: {
                                id: product_id,
                                type: 'add',
                                action: 'item-quantity'
                            },
                            success: function(res){
                                var data = JSON.parse(res);
                                if(data['status'] == 'success'){
                                    $("#amount-price").text(data['totalPrice_in_de_remove']);
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
                $(document).on('click','.minus',function(){
                    var id = $(this).data("id");
                    var qty = parseInt($("#item-quantity_"+id).val()) - 1;
                        if(qty <= 0 || isNaN(qty)){
                            qty = 1;
                            $(this).val(1);
                        }
                    var product_id = $(this).data("product_id");
                    $("#item-quantity_"+id).val(qty);
                        $.ajax({
                            url: '$change_quantity_url',
                            method: 'POST',
                            data: {
                                id: product_id,
                                type: 'minus',
                                action: 'item-quantity'
                            },
                            success: function(res){
                                var data = JSON.parse(res);
                                // console.log(data);
                                if(data['status'] == 'success'){
                                    $("#amount-price").text(data['totalPrice_in_de_remove']);
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
            });

            // btn-remove section
        $('.btn-remove-item').click(function(e){
            e.preventDefault();
            let timerInterval
                Swal.fire({
                title: 'Deleting!',
                html: 'I will close in <b></b> milliseconds.',
                timer: 500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
                })
            var id = $(this).closest('.btn-remove-item').data('id');
            $.ajax({
                url: '',
                method: 'POST',
                data: {
                    id: id,
                    action: 'btn_remove_item',
                },
                success: function(res){
                    var data = JSON.parse(res);
                    console.log(data);
                    // $("#available_item").text(data['totalCart']);
                    $("#amount-item").text(data['totalItem']);
                    $("#amount-price").text(data['totalPrice_in_de_remove']);
                    $("#totalprice").text(data['totalPrice_in_de_remove']);
                    if(data['status'] == 'success'){
                        $(".row_item_"+id).remove();
                        $("#cart-quantity").text(data['totalCart']);
                    }
                },
                error: function(err){
                    console.log(err);
                }
        });
    });
        $('.btn-save-for-later').click(function(ev){
            ev.preventDefault();
            var id = $(this).closest('.btn-save-for-later').data('id');
            var save_id = $(this).closest('.btn-save-for-later').data('save');
        $.ajax({
                url: '',
                method: 'POST',
                data: {
                    id: id,
                    save_id: save_id,
                    action: 'save_for_later'
                },
                success: function(res){
                    var parseData = JSON.parse(res);
                    // console.log(parseData);

                    // console.log(parseData.product_save_later);
                    var section = '';
                    for(var i = 0; i < parseData.product_save_later.length; i++) {
                        var data = parseData.product_save_later[i];
                       
                        section += `<div class="sec-border rounded-0 hover p-3 row_item_\${data.id}">
                            <div class="row ">
                                <div class="col-2">
                                    <a href=""><img src="$base_url/frontend/\${data.url}" style="width:50px"></a>
                                </div>
                                <div class="col-6">
                                    <span class="status"> \${data.status}
                                    </span><br>
                                    <div class="d-flex justify-content-start">
                                        <span class="price" style="padding-top:10px;padding-right:10px"> $\${data.price}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-secondary btn-sm rounded-0 btn-move-to-cart" data-save="\${data.id}" href="">Move to cart</a>
                                </div>
                            </div>
                        </div>`;
                    }

                    $("#Save_later_list").html(section);

                    if(parseData['status'] == 'success'){
                        $("#amount-price").text(parseData['totalPrice_in_de_remove']);
                        $(".row_item_"+id).remove();
                         $("#cart-quantity").text(parseData['totalCart']);
                    }
                },
                error: function(err){
                    console.log(err);
                }
        });
        });
        $('.btn-move-to-cart').click(function(){
                    var save_id = $(this).closest('.btn-move-to-cart').data('save');
                    // console.log(save_id);
                $.ajax({
                        url: '',
                        method: 'POST',
                        data: {
                            save_id: save_id,
                            action: 'move-to-cart'
                        },
                        success: function(res){
                            var parseData = JSON.parse(res);
                            
                            // $.each(data.product_save_later, function(index,data){
                                
                            // })
                           
                             console.log(section)
                            
                            if(parseData['status'] == 'success'){
                                $(".row_item_"+id).remove();
                            }
                           

                        },
                        error: function(err){
                            console.log(err);
                        }
                });
                });
    $(".action_delete").click(function(){
        console.log("hi");
    })

    if ($(".back-dark")[0]){
            $(".loader").css("background-color","#082032");
        }else{
            $(".loader").css("background-color","#edf2fc");
        }

    JS;
$this->registerJs($script);


?>