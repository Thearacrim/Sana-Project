<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Booking Histroy';
$base_url = Yii::getAlias("@web");
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .table {
        margin-top: 20%;
        margin-bottom: 20%;
    }
</style>
<div class="container ">
    <table class="table table-hover ">

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <?php foreach ($mybooking as $key => $value) { ?>
            <tbody>
                <tr>
                    <th scope="row"><?= $value['code'] ?></th>
                    <td><?= $value['customer_id'] ?></td>
                    <td><?= $value['grand_total'] ?></td>
                    <td><?= $value['sub_total'] ?></td>
                    <td><?= $value['code'] ?></td>
                    <td><a href="" class="btn-sm btn-dark">View Detail</a></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>


</div>