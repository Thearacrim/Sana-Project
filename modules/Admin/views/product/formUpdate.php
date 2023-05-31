<?php

use dosamigos\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
// $base_url = str_replace("app", '', Yii::$app->request->baseUrl);

?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]);?>
    <div class="row">
        <div class="col-lg-8">
            <?=$form->field($model, 'status')->textInput(['maxlength' => true, 'placeholder' => 'Blog Title'])->label(false)?>

            <?=$form->field($model, 'category_id')->textInput(['placeholder' => 'Category Id'])->label(false)?>

            <?=$form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price'])->label(false)?>

            <?=$form->field($model, 'description')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'basic',
])?>

        </div>
        <div class="col-lg-4">
            <div class="form-upload-image">
                <div class="preview">
                    <?=Html::img($model->isNewRecord ? Yii::getAlias("@web/uploads/orionthemes-placeholder-image-1.png") : $model->getThumbUploadUrl('image_banner'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview'])?>
                </div>
                <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
                <?= $form->field($model, 'image_url')->fileInput(['multiple' => true,'accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
            </div>

            <div class="form-upload-image_Update">
                <?php 
            
            foreach ($relateImage as $key => $image) {
                ?>
                <div class="preview" style="display: flex;
    align-items: baseline;
    justify-content: space-around;">
                    <?=Html::img($image->getThumbUploadUrl('image_banner'), ['class' => 'img-thumbnail', 'id' => 'image_upload-preview'])?>
                </div>
                <?= $form->field($image, 'image_relate')->fileInput(['multiple' => true,'accept' => 'image/*', 'id' => 'image_upload'])->label(false) ?>
                <?php
            }    
            ?>
                <label for="image_upload"><i class="fas fa-image"></i> Upload Image</label>
            </div>

            <?= $form->field($model, 'type_item')->dropDownList(['1' => 'T-Shirt Women', '2' => 'T-Shirt Man',
             '3' => 'Jeans Man', '4' => 'Jeans Woman', '5' => 'Hoodies & Sweeter Man', '6' => 'Hoodies & Sweeter Woman','7'=>'Shirts Short Sleeves Man'
            ,'8'=>'Dresses
            &
            Jumpsuits','9'=>'Shirts Long Sleeves Man','10'=>'Sport Man','11'=>'OXFORD Shirt','12'=>'Hat Man',
            '13'=>'Joggers Man','14'=>'Joggers Women','15'=>'Tanks',
            '16'=>'Pants && Trousers Man','17'=>'Short Pants Man','18'=>'Sports','19'=>'Dresses
            &
            Jumpsuits','20'=>'Shirts & Tops Woman','21'=>'Jackets & Raincoats','22'=>'Pants &
            Trousers Woman','23'=>'Short
            Pants Woman','24'=>'Skirts Woman','25'=>'Shirts &Tops','26'=>'Jackets
            &
            Raincoats','27'=>'Headwear'], ['placeholder' => 'Type Item'])->label(false) ?>
            <div class="text-center">
                <?=Html::submitButton('Save', ['class' => 'btn btn-primary w-50 rounded-0', 'id' => "btn_save"])?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end();?>

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
    JS;
$this->registerJs($script);

?>