<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$updated = Yii::$app->session->hasFlash('success') ? 1 : 0;
?>
<div class="order-item-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            'product_id',
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
            ],
            [
                'attribute' => 'total',
                'value' => function ($model) {
                    return '$ ' . $model->total;
                },
            ],
        ],
    ]) ?>

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