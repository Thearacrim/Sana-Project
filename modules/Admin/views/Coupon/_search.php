<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\FlatepickrAsset;
/* @var $this yii\web\View */
/* @var $model app\modules\Admin\models\CouponSearch */
/* @var $form yii\widgets\ActiveForm */

FlatepickrAsset::register($this);
?>

<div class="coupon-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => ['id' => 'formCouponSearch', 'data-pjax' => true],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-6">
            <label>Date Range</label>
            <div id="order__date__range" style="cursor: pointer;background-color: #f8f9fc;" class="form-control">
                <i class="fas fa-calendar text-muted"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down text-muted float-right"></i>
            </div>
            <?= $form->field($model, 'from_date')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'to_date')->hiddenInput()->label(false) ?>
        </div>
        <div class="col-lg-6">
            <label>Search</label>
            <?= $form->field($model, 'globalSearch')->textInput([
                'placeholder' => 'Search...', 'aria-label' => 'Search', 'type' => 'search',
                'class' => 'form-control form-control-navbar',
                'style' => 'background-color: #f8f9fc;'
            ])->label(false) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS
    $(".flatpickr").flatpickr();
    var is_filter = $("#couponsearch-from_date").val() != ''?true:false;

    if(!is_filter){
        var start = moment().startOf('week');
        var end = moment();
    }else{
        var start = moment($("#couponsearch-from_date").val());
        var end = moment($("#couponsearch-to_date").val());
    }

    function cb(start, end) {
        $('#order__date__range span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#couponsearch-from_date").val(start.format('YYYY-MM-D'));
        $("#couponsearch-to_date").val(end.format('YYYY-MM-D'));
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
        $('#formCouponSearch').trigger('submit');
    });

    $(document).on("change","#productsearch-globalsearch", function(){
        $('#formCouponSearch').trigger('submit');
    });
    JS;
$this->registerJs($script);

?>