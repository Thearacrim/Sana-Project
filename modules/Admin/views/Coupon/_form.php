    <div class="table-me mr-5 ml-5">
        <?php

        use yii\helpers\Html;
        use yii\widgets\ActiveForm;
        use app\assets\FlatepickrAsset;

        /* @var $this yii\web\View */
        /* @var $model app\modules\Admin\models\Coupon */
        /* @var $form yii\widgets\ActiveForm */

        FlatepickrAsset::register($this);
        ?>

        <div class="coupon-form">

            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-8">
                    <?= $form->field($model, 'coupon_title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'discount_on')->dropDownList(['all product' => 'All product', 'clothes' => 'Clothes', 'shoes' => 'Shoes', '' => '',], ['prompt' => '']) ?>
                </div>
                <div class="col-4">

                    <?= $form->field($model, 'coupon_type')->dropDownList(['percentage' => 'Percentage', 'amount' => 'Amount',], ['prompt' => '']) ?>

                    <div class="form-group">
                        <label for="expire_date">Expire Date</label>
                        <input type="hidden" class="form-control flatpickr flatpickr-input" id="expire_date" name="Coupon[expire_date]" placeholder="Expire Date" required="">
                        <!-- <input class="form-control flatpickr input" placeholder="Expire Date" required="" tabindex="0" type="text" readonly="readonly"> -->
                    </div>

                    <?= $form->field($model, 'status')->dropDownList(['public' => 'Public', 'draft' => 'Draft',], ['prompt' => '']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
    <?php
    $script = <<< JS
    $(".flatpickr").flatpickr();
    JS;
    $this->registerJs($script);


    ?>