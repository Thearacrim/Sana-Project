<style>
    #form-signup {
        width: 400px;
        margin: auto;
    }

    .sign {
        background: #edf2fc;
    }

    .forget_pass {
        display: contents;
    }

    hr {
        border: none;
        height: 2px;
        background: #dddddd;
    }
</style>
<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'CREATE ACCOUNT';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="site-signup container">
    <hr>
    <div class="w-50 sign m-auto shadow">

        <br>
        <h2 class="text-center"><?= Html::encode($this->title) ?></h2>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form->field($model, 'first_name') ?>

        <?= $form->field($model, 'last_name') ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <div class="form-group d-flex justify-content-center">

            <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
            
        <br>

        <?php ActiveForm::end(); ?>
    </div>
    <hr>
    <br>
    <br>
    <br>
</div>