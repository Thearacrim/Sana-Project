<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

$base_url = Yii::getAlias('@web');
?>
<script
    src="https://www.paypal.com/sdk/js?client-id=AbRk2q_sjpztKSLPgjJpKZDC8eXmUzk5LM8Lv61_E2wkjtMFuxuUmiJW3mNmQULgQ-of3k4ZmafKQsBB">
</script>
<div class="container">
    <div class="row mb-5">
        <div class="col-lg-7 col-md-7 col-sm-12 pt-5">
            <!-- <div class="loader">
            </div> -->
            <div class="loading">

                <div class="w-100 pt-5 paypal-btn">
                    <div id="smart-button-container">
                        <div>
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                    <script>
                    function initPayPalButton() {
                        paypal.Buttons({
                            style: {
                                shape: 'rect',
                                color: 'gold',
                                layout: 'vertical',
                                label: 'paypal',

                            },

                            createOrder: function(data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        "amount": {
                                            "currency_code": "USD",
                                            "value": 0.1
                                        }
                                    }]
                                });
                            },
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(orderData) {
                                    console.log('Capture result', orderData);
                                    var postal_code = orderData.purchase_units[0].shipping
                                        .address
                                        .postal_code;
                                    var transaction = orderData.purchase_units[0].payments
                                        .captures[
                                            0];
                                    var status = transaction.status;
                                    var payer_id = orderData.id;
                                    var id = $('.sec-border').data("id");
                                    $.ajax({
                                        url: '<?= Url::to(['payment']) ?>',
                                        method: 'POST',
                                        data: {
                                            payer_id: payer_id,
                                            postal_code: postal_code
                                        },
                                        success: function(res) {
                                            var data = JSON.parse(res);
                                            console.log(data);
                                        },
                                        error: function(err) {
                                            console.log(err);
                                        }
                                    });
                                });
                            },
                            onError: function(err) {
                                console.log(err);
                            }
                        }).render('#paypal-button-container');
                    }

                    initPayPalButton();
                    </script>
                </div>
                <h2 class="fw-bold p-3 text-color">Order Details</h2>
                <div class="pb-5">
                    <?php foreach ($relatedProduct as $key => $product) { ?>
                    <div class="sec-border-checkout rounded-0 hover row_item_<?= $product['cart_id'] ?>"
                        data-id=<?= $product['cart_id'] ?>>
                        <div class="row ">
                            <div class="col-4">
                                <img src="<?= $base_url . '/' . $product['image_url'] ?>" style="width:73px">
                            </div>
                            <div class="col-4 py-5">
                                <span class="fw-bold text-color"> <?= $product['status'] ?>
                            </div>
                            <div class="col-4 py-5">
                                <span class="fw-bold text-color"> $<?php
                                                                        if ($product['quantity'] == 1) {
                                                                            echo $product['price'];
                                                                        } else {
                                                                            echo $product['price'] . "(x" . $product['quantity'] . ")";
                                                                        }

                                                                        ?></span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="col-lg-5">
            <div class="border-shadow p-3" style="position: -webkit-sticky;position: sticky;top: 150px;">
                <h3 class="text-color">Summary</h3>
                <div class="row border-bottom border-dark pt-3">
                    <div class="col-6">
                        <h6 class="text-color">Original Price (<?= $totalCart ?>)</h6>
                    </div>
                    <div class="col-6 text-right mb-0">
                        <h6 class="text-color"></h6>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-6">
                        <h6 class="fw-bold text-color">Total :</h6>
                    </div>
                    <div class="col-6 text-right">
                        <h6 class="fw-bold text-color">$ <?= $totalPrice ?></h5>
                    </div>
                </div>
                <span class=" text-right text-color" style="font-size:13px; "> Zay is required by law to collect
                    applicable transaction taxes for purchases made in certain tax jurisdictions.</span>
                <span class=" text-right text-color" style="font-size:13px ;text-indent: 30%;">By completing your
                    purchase you agree to these <a class=" text-right" style="font-size:13px;color:purple"
                        href="#">Terms of Service.</a></span>

            </div>
        </div>
    </div>
</div>

<?php

$script = <<< JS

    setTimeout(function(){
                $('.loader').css('display','none');
                $('.paypal-btn').css('display','block');
            }, 3000);
    var loader = document.getElementById('preloader');
    var blockpayment = document.getElementById('loader-block');
    window.addEventListener('load', function(){
        blockpayment.style.display="block";
        // loader.style.display="none";
    })
    JS;
$this->registerJs($script);
?>