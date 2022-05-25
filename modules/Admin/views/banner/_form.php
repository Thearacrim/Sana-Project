<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">

        <div class="col-lg-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title'])->label(false) ?>

            <?= $form->field($model, 'sort_description')->textInput(['maxlength' => true, 'placeholder' => 'Sort Description'])->label(false) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description'])->label(false) ?>

            <div class="form-upload-image">
                <div class="preview">
                    <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/backend/uploads/orionthemes-placeholder-image-1.png") : $model->getThumbUploadUrl('image_banner'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview']) ?>
                </div>
                <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="col-lg-8">

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
    $("#image_upload").change(function(){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("image_upload-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    });
    JS;
$this->registerJs($script);

?>