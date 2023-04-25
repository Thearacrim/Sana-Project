<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
$base_url = Yii::getAlias('@web');
$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]);?>
<div class="div container">
    <div class="row">
        <?php if($customer){?>
        <div class="col-lg-6">
            <h2 class="mb-5 text-color testing" id="">CheckOut</h2>
            <p class="text-color">Billing Information</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=$form->field($modelValue, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City...'])->label(false)?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=$form->field($modelValue, 'address')->textarea(['rows' => '6', 'placeholder' => 'Address...'])->label(false)?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=$form->field($modelValue, 'phone_number')->textInput(['maxlength' => true, 'placeholder' => 'Phone Number...'])->label(false)?>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="m-3 ">
                    <?=Html::submitButton('Place Order', ['class' => 'btn btn-primary w-25 rounded-0', 'id' => "btn_save"])?>
                </div>
            </div>
        </div>
        <?php }else{ ?>
        <div class="col-lg-6">
            <h2 class="mb-5 text-color testing" id="">CheckOut</h2>
            <p class="text-color">Billing Information</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=$form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City...'])->label(false)?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=$form->field($model, 'address')->textarea(['rows' => '6', 'placeholder' => 'Address...'])->label(false)?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?=$form->field($model, 'phone_number')->textInput(['maxlength' => true, 'placeholder' => 'Phone Number...'])->label(false)?>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="m-3 ">
                    <?=Html::submitButton('Place Order', ['class' => 'btn btn-primary w-25 rounded-0', 'id' => "btn_save"])?>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="col-lg-6">
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
</div>
<?php ActiveForm::end();?>