<style>
    #login-form {
        margin: auto;
        width: 350px;
    }

    .sign {
        width: 100%;
    }

    .foget_pass {
        display: contents;
    }

    .form-control {
        background: #EDF2FC;
    }

    hr {
        border: none;
        height: 2px;
        background: #dddddd;
    }

    .img {
        width: 100%;
    }

    /* @media screen and (max-width: 600px) {
        .respon {
        width: 100%;
        }
    } */
</style>
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use app\models\LoginForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'SIGN IN';

$this->params['breadcrumbs'][] = $this->title;
?>
<div style="text-align:center;margin-top: 80px;">
    <h1>WELCOME BACK</h1>
</div>

<div class="site-login">
    <div class="container w-100">
        <hr>
        <div class="row">
            <div class="col respon">
                <br>
                <h2 class="text-center"><?=Html::encode($this->title)?></h2>
                <!-- Login User -->
                <?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
])?>
                <?=$form->field(
    $model,
    'username',
    ["template" => "<label> Email </label>\n{input}\n{hint}\n{error}"]
)->textInput()?>

                <?=$form->field($model, 'password')->passwordInput()?>

                <?=$form->field($model, 'rememberMe')->checkbox()?>
                <div class="form-group text-center">
                    <?=Html::submitButton('SIGN IN WITH USER', ['class' => 'btn btn-dark', 'name' => 'login-button', "id" => "btn-login"])?>
                </div>
                <div class="text-center" style="color:#999;margin:1em 0">
                    <?=Html::a('Forget your password?', ['site/request-password-reset'], ['class' => 'foget_pass text-secondary'])?>
                    <br>
                </div>

            </div>
            <div class="col sign ">
                <img class="img" src="img/clark-street-mercantile-qnKhZJPKFD8-unsplash.jpg" alt="">
            </div>
        </div>
        <?php ActiveForm::end();?>
        <hr>
    </div>

</div>

</div>
<br>
<div style="text-align:center;margin-bottom: 150px">
    <h4>NEW TO LEVEL SROTE 89</h4>
    <a style="cursor:poiter" href="<?=Url::to(['/site/sign'])?>" class="btn btn-dark">CREATE ACCOUNT</a>
</div>