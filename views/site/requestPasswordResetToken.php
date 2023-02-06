<style>
      #login-form{
        margin:auto;
        width:400px;
    }
    .sign{
    /* background: #f0f0f0; */
    }
    .foget_pass{
        display:contents;
    }
    .form-control{
        background:#EDF2FC;
    }
    hr{
        border:none;
        height:2px;
        background:#dddddd;
    }

</style>
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\authclient\ClientInterface;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'RESET YOUR PASSWORD';

$this->params['breadcrumbs'][] = $this->title;
?>
    <div style="text-align:center;margin-top: 80px;">
        <h1>WELCOME BACK</h1>
    </div>

<div class="site-login">
    <div class="container w-100">
        <hr>
        <div class="row">
            <div class="col">
                <br>
                <h2 class="text-center"><?= Html::encode($this->title) ?></h2>
                <P>We will send you an email to reset your password</P>
                <!-- Login User -->
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                ]) ?>
                <?= $form->field($model, 'email') ?>


                
                <div class="form-group text-center">
                    <?= Html::submitButton('SUBMIT', ['class' => 'btn btn-dark', 'name' => 'login-button', "id" => "btn-login"]) ?>
                </div>
                 <div class="text-center" style="color:#999;margin:1em 0">
                    <?= Html::a('or Cancel', ['site/login'],['class' => 'foget_pass text-secondary']) ?>
                    <br>
                </div>
               
            </div>
            <div class="col sign">
                <div class="container">
                    <img src="img/clark-street-mercantile-qnKhZJPKFD8-unsplash.jpg" alt="" style="width:570px";>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <hr>
        </div>
        
    </div>
   
</div>
<br>
    <div style="text-align:center;margin-bottom: 150px">
        <h4 >NEW TO LEVEL SROTE 89</h4>
        <a style="cursor:poiter" href="<?= Url::to(['/site/sign']) ?>" class="btn btn-dark">CREATE ACCOUNT</a>
    </div>
