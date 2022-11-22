<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="container">
        //Signup User
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'first_name') ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'last_name') ?>
            </div>
        </div>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'email') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>