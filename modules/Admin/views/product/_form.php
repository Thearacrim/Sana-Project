<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use dosamigos\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="row">
        <div class="col-lg-8">
            <?= $form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Blog Title'])->label(false) ?>

            <?= $form->field($model, 'category_id')->textInput(['placeholder' => 'Category Id'])->label(false) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price'])->label(false) ?>

            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ])  ?>

        </div>
        <div class="col-lg-4">
            <div class="form-upload-image">
                <div class="preview">
                    <?= Html::img($model->isNewRecord ? Yii::getAlias("@web/uploads/orionthemes-placeholder-image-1.png") : $model->getThumbUploadUrl('image_banner'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview']) ?>
                </div>
                <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                <?= $form->field($model, 'image_url')->fileInput(['accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
            </div>

            <?= $form->field($model, 'type_item')->dropDownList(['1' => 'Women', '2' => 'Man', '3' => 'Glasses', '4' => 'Bag', '5' => 'watch', '6' => 'Shores'], ['placeholder' => 'Type Item'])->label(false) ?>
            <div class="text-center">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary w-50 rounded-0', 'id' => "btn_save"]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
    $('.isSelect2').select2({
        placeholder: "Select a state",
        width: "100%",
    });
    $("#image_upload").change(function(){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("image_upload-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    });
    $("#btn_save").click(function(){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
            })
    })
    JS;
$this->registerJs($script);

?>