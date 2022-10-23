<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'coupon_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount_on')->dropDownList([ 'all product' => 'All product', 'clothes' => 'Clothes', 'shoes' => 'Shoes', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'coupon_type')->dropDownList([ 'percentage' => 'Percentage', 'amount' => 'Amount', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'expire_date')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'public' => 'Public', 'draft' => 'Draft', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
