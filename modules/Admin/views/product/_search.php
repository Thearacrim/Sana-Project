<?php

use yii\helpers\Html;
use app\assets\AdminAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

AdminAsset::register($this);

?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['id' => 'formProductSearch', 'data-pjax' => true],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-5">
            <label>Date Range</label>
            <div id="order__date__range" style="cursor: pointer;background-color: #f8f9fc;" class="form-control">
                <i class="fas fa-calendar text-muted"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
            </div>
            <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-lg-5">
            <label>Search</label>
            <?= $form->field($model, 'globalSearch')->textInput([
                'placeholder' => 'Search...', 'aria-label' => 'Search', 'type' => 'search',
                'class' => 'form-control form-control-navbar',
                'style' => 'background-color: #f8f9fc;'
            ])->label(false) ?>
        </div>
        <div class="col-lg-2">
            <p>
                <a type="button" href="<?= Url::to(['product/create']) ?>" class="btn btn-primary float-right btn1 rounded-circle action trigggerModal"><i class="fas fa-plus"></i></a>
            </p>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
    // $(document).on("click",".trigggerModal",function(){
    //     $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
    // });
    var is_filter = $("#productsearch-from_date").val() != ''?true:false;

    if(!is_filter){
        var start = moment().startOf('week');
        var end = moment();
    }else{
        var start = moment($("#productsearch-from_date").val());
        var end = moment($("#productsearch-to_date").val());
    }

    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#productsearch-from_date").val(start.format('YYYY-MM-D'));
        $("#productsearch-to_date").val(end.format('YYYY-MM-D'));
    }

    $('#order__date__range').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'This Week': [moment().startOf('week'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    $('#order__date__range').on('apply.daterangepicker', function(ev, picker) {
        $('#formProductSearch').trigger('submit');
    });

    $(document).on("change","#productsearch-globalsearch", function(){
        $('#formProductSearch').trigger('submit');
    });


    // $(".triggerModal").click(function(){
    //     $("#modal").modal("show")
    //         .find("#modalContent")
    //         .load($(this).attr("value"));
    //     $("#modal").find("#modal-label").text($(this).data("title"));

    // });
    JS;
$this->registerJs($script);

?>