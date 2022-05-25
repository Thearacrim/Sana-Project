<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="card p-3">
                <?= $form->field($model, 'order_id')->textInput() ?>

                <?= $form->field($model, 'product_id')->textInput() ?>

                <?= $form->field($model, 'color')->dropDownList(['1' => 'Blue', '2' => 'Red', '3' => 'Yellow', '4' => 'White', '5' => 'Black'])->label("Color") ?>

                <?= $form->field($model, 'size')->dropDownList(['1' => 'M', '2' => 'L', '3' => 'XL', '4' => 'XXL'])->label("Size") ?>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3">
                <?= $form->field($model, 'qty')->textInput() ?>

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary w-25  rounded-0', 'id' => 'btn_save']) ?>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    // $("#btn_save").click(function(){
    //     const Toast = Swal.mixin({
    //         toast: true,
    //         position: 'top-end',
    //         showConfirmButton: false,
    //         timer: 3000,
    //         timerProgressBar: true,
    //         didOpen: (toast) => {
    //             toast.addEventListener('mouseenter', Swal.stopTimer)
    //             toast.addEventListener('mouseleave', Swal.resumeTimer)
    //         }
    //         })

    //         Toast.fire({
    //         icon: 'success',
    //         title: 'Signed in successfully'
    //         })
    // })
    JS;
$this->registerJS($script);
?>