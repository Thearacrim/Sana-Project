<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Login'; ?>
<div class="text-center">
</div> 
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'user']]); ?> 
<?= $form->field($model, 'username')->textInput(['class' => 'form-control form-control-user', 'placeholder' => 'Username'])->label(false) ?> 
<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control form-control-user', 'placeholder' => 'Enter your password'])->label(false) ?> 
<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?> 
<div class="form-group text-center pt-3">
  <div class="custom-control custom-control-inline custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="remember-me"> <label class="custom-control-label" for="remember-me">Keep me sign in</label>
  </div>
</div>
<?php ActiveForm::end(); ?>
<hr>
