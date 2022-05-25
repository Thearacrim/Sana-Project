<?php

use app\modules\Admin\models\Product;

$products = Product::find()->one();

use yii\helpers\Url;
?>
<!-- Modal -->
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="w-100 pt-1 mb-5 text-right">
      <button type="button" class="btn-close btn btn-outline-none" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form id="frmSearch" action="<?= Url::to(['site/search', 'title' => $products->id]) ?>" method="get" class="modal-content modal-body border-0 p-0">
      <?= $this->render('search') ?>
    </form>
  </div>
</div>