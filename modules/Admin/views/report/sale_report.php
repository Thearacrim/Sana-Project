<style>
    .grand-total {
        margin-left: 200px;
        font-size: 30px;
    }
</style>
<div class="table-me mr-5 ml-5">
    <?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

    $this->title = Yii::t('app', 'Sale Report'); ?>
    <?php
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="card back-light p-5" style="box-shadow: 0 0.125rem 0.5rem 0 rgb(0 0 0 / 16%);">
        <div class="product-index">
            <div class="card-header back-light">
                <h1 class="text-color"><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="card-body back-light">
                <div class="section-block">

                    <?php $form = ActiveForm::begin([
                        'action' => ['sale-report'],
                        'options' => ['id' => 'formProductSearch', 'data-pjax' => true],
                        'method' => 'get',
                    ]); ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <label>End of day report</label>
                            <input type="text" name="dateRange" value="<?= $fromDate . ' - ', $toDate ?>" id="dateRange" class="form-control" readonly />
                        </div>
                    </div>
                    <button type="submit" id="submitSearch" hidden class="hide">Submit</button>
                    <?php ActiveForm::end(); ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sale date</th>
                                <th>Customer</th>
                                <th>Code</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($sale_report as $key => $value) : ?>
                                <tr>
                                    <td><?= $value['id'] ?></td>
                                    <td><?= Yii::$app->formatter->asDate($value['created_date']) ?></td>
                                    <td><?= $value['customer_name'] ?></td>
                                    <td><?= $value['code'] ?></td>
                                    <td><?= $value['status'] ?></td>
                                    <td><?= $value['price'] ?></td>
                                    <td class="text-center"><?= $value['qty'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">Total Revenue</th>
                                <th>$ <?= $totalPrice ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$script = <<<JS
$('#dateRange').daterangepicker({
      autoUpdateInput: false,
      drops: 'down',
      locale: {
          cancelLabel: 'Cancel',
            format: 'YYYY-MM-DD'
      }
  });

  $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
      $('#submitSearch').trigger('submit');
  });

  $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
      // $(this).val('');
  });
JS;
$this->registerJs($script);
?>