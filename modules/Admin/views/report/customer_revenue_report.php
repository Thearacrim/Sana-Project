<style>
    .grand-total {
        margin-left: 167px;
        font-size: 30px;
    }
</style>
<div class="table-me mr-5 ml-5">
    <?php

    use Faker\Guesser\Name;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

    $this->title = Yii::t('app', 'Customer Revenue Report'); ?>
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
                    'action' => ['customer-revenue-report'],
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
                                <th>Customer </th>
                                <th>Total</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($customer_revenue_report as $key => $value) : ?>
                                <tr>
                                    <td><?= $value['customer_id'] ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $value['price'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Revenue</th>
                                <th>$ <?= array_sum(array_column($customer_revenue_report,'price')); ?></th>
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