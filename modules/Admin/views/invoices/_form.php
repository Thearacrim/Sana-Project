<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Customer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Issue_date')->textInput() ?>

    <?= $form->field($model, 'Due_date')->textInput() ?>

    <?= $form->field($model, 'Type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Paid' => 'Paid', 'Open' => 'Open',], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>