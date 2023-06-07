<?php

/* @var $this yii\web\View */

use app\models\OrderItem;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'View Booking Histroy';
$base_url = Yii::getAlias("@web");
$this->params['breadcrumbs'][] = $this->title;

?>
<style>
    .form-center {
        width: 929px;
        border: 1px solid;
        margin-top: 40px;
        margin-bottom: 100px;
        margin-left: 20%;
    }

    h2 {
        margin-top: 54px;
        margin-bottom: 54px;
        margin-left: 7%;
    }
    .table_botton{
        margin-bottom: 110px;
    }
</style>
<h2>My Booking</h2>
<div class="container container  rounded-top table_botton">
    <table class="table table-hover py-5">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Grand Total</th>
                <th scope="col">Date Booking</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($view_order as $key => $value) : ?>
                <tr>
                    <td><?= $value['code'] ?></td>
                    <td><?= $value['grand_total'] ?></td>
                    <td><?= Yii::$app->formater->timeAgo($value['created_date']) ?></td>
                    <td>
                        <a class="btn  btn-secondary" href="<?= Url::to(['site/detail-booking-history', 'id' => $value['id']]) ?>">View Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>