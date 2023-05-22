<?php

/* @var $this yii\web\View */

use app\models\OrderItem;
use yii\helpers\Html;

$this->title = 'Booking Histroy';
$base_url = Yii::getAlias("@web");
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->user->isGuest) {
    $userId = Yii::$app->user->id;
  };
?>

<style>
    
    .title {
        font-style: italic;
    }
</style>
<div class="container">
    <h2 class="title">My Booking</h2>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Color</th>
                <th scope="col">Size</th>
                <th scope="col">Qty</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mybooking as $key => $value) : ?>
                <tr>
                    <th><img src="<?= $base_url . '' . $value['image_url'] ?>"style="width:100px"></th>
                    <td><?= $value['status'] ?></td>
                    <td><?= $value['color'] ?></td>
                    <td><?= $value['size'] ?></td>
                    <td><?= $value['qty'] ?></td>
                    <td><?= $value['price'] ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- <button type="button" class="btn btn-dark">Dark</button> -->
        </tbody>
    </table>
</div>