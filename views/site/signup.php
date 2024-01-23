<style>
    #form-signup{
        width:400px;
        margin:auto;
    }
    .sign{
        background:#f7f7f7;
    }
     .forget_pass{
        display:contents;
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
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'CREATE ACCOUNT';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup container">

    <div style="text-align:center;margin-top: 80px;">
        <h1>NEW TO MOI OUTFIT?</h1>
    </div>
    <hr>
    <div class="w-50 sign m-auto">
    
        <h2 class="text-center"><?= Html::encode($this->title) ?></h2>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'first_name') ?>
           
        <?= $form->field($model, 'last_name') ?>
          

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>


        <div class="form-group d-flex justify-content-center">
           
            <?= Html::submitButton('CREATE', ['class' => 'btn btn-dark', 'name' => 'signup-button']) ?>
        </div>
        <div class="text-center" style="color:#999;margin:1em 0">
            <?= Html::a('or Return to Store', ['site/store-man'],['class' => 'forget_pass text-secondary']) ?>      
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <hr>
     <br>
    <br>
    <br>
</div>