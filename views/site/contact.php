<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Contact';
// $this->params['breadcrumbs'][] = $this->title;
// 
?>
<div class="site-contact">
    <!-- Start Content Page -->
    <div class="container-fluid back-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1 text-color">Contact Us</h1>
            <p class="text-color">
                Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet.
            </p>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d31052.531461834078!2d103.8803606!3d13.3772139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2skh!4v1650957310442!5m2!1sen!2skh"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<!-- Replace the value of the key parameter with your own API key. -->
<h1 class="text-center pt-5 pb-5 text-color">Messages</h1>
<!-- Start Contact -->
<div class="container">
    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'email') ?>
                </div>
            </div>
            <?= $form->field($model, 'subject') ?>
            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
            <!-- <script src="https://www.google.com/recaptcha/api.js"></script>
            <div class="g-recaptcha pt-5 pb-5" data-sitekey="6Ld77J8fAAAAAPoq_6VzMGlm-bxYkRtP2k2Q2V5s"></div> -->
        </div>
        <div class="col-lg-6">
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<!-- End Contact -->


</div>

<?php

$script = <<< JS
function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
JS;
$this->registerJs($script);


?>