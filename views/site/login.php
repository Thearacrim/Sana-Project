<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\authclient\ClientInterface;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="container">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        //Login User
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            // 'validateOnBlur' => false,
            // 'validateOnType' => false,
            // 'validateOnChange' => false,

        ]) ?>
        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="text-center" style="color:#999;margin:1em 0">
            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            <br>
            Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
        </div>
        <div class="form-group text-center">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button', "id" => "btn-login"]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<< JS
//Login User
$('#login-form').on('beforeSubmit', function(e)
{
    var \$form = $(this);
    $.post(
        \$form.attr("action"), //serialize yii2 form
        \$form.serialize()
    )
        .done(function(result) {
            if(result.password == null) {   
            alert('Incorrect username or password.');
        }
        });
        return false;
}); 
JS;
$this->registerJs($script);
?>