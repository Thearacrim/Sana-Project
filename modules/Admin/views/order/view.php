<?php

use yii\bootstrap4\LinkPager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

$updated = Yii::$app->session->hasFlash('success') ? 1 : 0;
/* @var $this yii\web\View */
/* @var $model backend\models\Invoices */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoices-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->
    <div class="card rounded-0 back-light">
        <div class="card-header bg-primary rounded-0">
            <h3 class="text-color">Invoices</h3>
        </div>
        <div class="row pt-5 pb-5">
            <div class="col-lg-6 pl-5 fw-bold text-color">
                <p lang="kh"><ins>ឈ្មោះអតិថជន </ins>: <?= $customer["name"] ?></p>
                <p><ins>Client Address </ins>: <?= $customer['address'] ?></p>
                <p><ins>Invoices ID </ins>: <?= $order->code ?></p>
                <p><ins>Date of Issue </ins>: <?= $invoice->Issue_date ?></p>
            </div>
            <div class="col-lg-6 fw-bold text-primary text-right">
                <ins>Invoices Total</ins>
                <h1> $ <?= $order_item["total_price"] ?></h1>
            </div>
        </div>
        <div class="card-body back-light">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => [
                    'class' => 'table table-hover text-color',
                    'cellspacing' => '0',
                    'width' => '100%',
                ],
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last',
                    'class' => LinkPager::class,
                ],
                'layout' => "
                    <div class='table-responsive'>
                        {items}
                    </div>
                    <hr>
                ",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'product_id',
                        'value' => 'product.status'
                    ],
                    [
                        'attribute' => 'color',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->getColor();
                        }
                    ],
                    [
                        'attribute' => 'size',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->getSize();
                        }
                    ],
                    [
                        'attribute' => 'qty',
                        'value' => function ($model) {
                            if ($model->qty > 1) {
                                return 'x' . $model->qty;
                            } else {
                                return $model->qty;
                            }
                        }
                    ],
                    [
                        'attribute' => 'price',
                        'value' => function ($model) {
                            return '$ ' . $model->price;
                        },
                        'contentOptions' => [
                            'style' => 'width:100px;'
                        ]
                    ],
                    [
                        'attribute' => 'total',
                        'value' => function ($model) {
                            return '$ ' . $model->price;
                        },
                        'contentOptions' => [
                            'style' => 'width:100px;'
                        ]
                    ],
                ],
            ]); ?>
            <div class="row pb-5">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6 text-right text-primary">
                    <h3>Sub Total</h3>
                    $<?= $order_item["total_price"] ?>
                </div>
            </div>
            <div class="row pt-5 pb-5 text-color">
                <div class="col-lg-6">
                    <h5>Notes</h5>
                    <p>Thanks for your business.</p>
                    <h5>Term & Conditions</h5>
                    <p>Your company's terms and Conditions will be displayed.</p>
                </div>
                <!-- <div class="col-lg-6 text-right text-primary">
                    <button class="btn btn-primary" onclick="window.print();">Print</button>
                </div> -->
            </div>
        </div>
    </div>

</div>
<?php
$script = <<< JS
    if($updated)
    {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
        })
    }
    JS;
$this->registerJS($script);
?>