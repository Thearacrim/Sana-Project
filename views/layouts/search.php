<?php

use app\modules\Admin\models\Product;
use yii\helpers\Url;

$products = Product::find()->all();
?>
<div class="dropdown">
  <div id="Dropdown" class="dropdown-content">
    <div class="input-group input-group-lg" style="flex-wrap: nowrap;">
      <input type="text" placeholder="Search..." id="myInput" name="ProductSearch[title]" onkeyup="filterFunction()">
      <button id="clickbtn" class="btn btn-primary rounded-0 pr-5 pl-5"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <?php foreach ($products as $product) { ?>
      <a class="search_link" href="<?= Url::to(['site/store-single?id=' . $product->id]) ?>"><?= $product->status ?></a>
    <?php } ?>
  </div>
</div>
<style>
</style>
<?php
$base_url = Yii::getAlias("@web");
$script = <<< JS
          var base_url = "$base_url";
          // $("#clickbtn").click(function () {
          //   var input = $("#myInput").val();
          // });
        JS;
$this->registerJs($script);
?>