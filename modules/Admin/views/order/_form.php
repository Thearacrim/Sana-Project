<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">
    <div class="row">
        <div class="col-lg-6">
            <div class="card p-5 back-light">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'customer_id')->textInput() ?>

                <?= $form->field($model, 'status')->textInput() ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary w-25 rounded-0', 'id' => 'btn_save']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<< JS
    $("#btn_save").click(function(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
            })
    })
    JS;
$this->registerJS($script);
?>