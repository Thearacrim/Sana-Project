<?php

use backend\models\OrderItem;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-me mr-5 ml-5">
    <div class="order-item-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <!-- <p>
            <?= Html::a('Create Order Item', ['create'], ['class' => 'btn btn-success']) ?>
        </p> -->
        <div class="card">
            <div class="card-body back-light">
                <?php echo $this->render('_search', ['model' => $searchModel, 'class' => 'form-control inp rounded-0']); ?>

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
                    <div class='row'>
                        <div class='col-md-6'>
                            
                        </div>
                        <div class='col-md-6'>
                            {pager}
                        </div>
                    </div>
                ",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'order_id',
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
                            'format' => ['currency'],
                            'contentOptions' => [
                                'style' => 'width:100px;'
                            ]
                        ],
                        [
                            'attribute' => 'total',
                            'format' => ['currency'],
                            'contentOptions' => [
                                'style' => 'width:100px;'
                            ]
                        ],
                        // [
                        //     'class' => ActionColumn::className(),
                        //     'urlCreator' => function ($action, OrderItem $model, $key, $index, $column) {
                        //         return Url::toRoute([$action, 'id' => $model->id]);
                        //     },
                        //     'header' => 'action',
                        // ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            // 'contentOptions' => ['style' => 'width: 7%'],
                            'visible' => Yii::$app->user->isGuest ? false : true,
                            'buttons' => [
                                'view' => function ($url) {
                                    return Html::a('<i class="fa-solid fa-eye"></i>', $url, ['class' => 'glyphicon glyphicon-eye-open btn btn-outline-info btn-sm rounded-circle btn-xs custom_button']);
                                },
                                'update' => function ($url) {
                                    return Html::a('<i class="fa-solid fa-pen-fancy"></i>', $url, ['class' => 'glyphicon glyphicon-pencil btn btn-outline-info btn-sm rounded-circle btn-xs custom_button']);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa-solid fa-trash-can"></i>', $url, [
                                        'title' => Yii::t('app', 'Delete'),
                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                        'data-method' => 'POST',
                                        'class' => 'glyphicon glyphicon-pencil btn btn-outline-info btn-sm rounded-circle btn-xs button_delete'
                                    ]);
                                }
                                // 'delete' => function ($url) {
                                //     return Html::a('<i class="fa-solid fa-trash-can"></i>', $url, [
                                //         'title' => Yii::t('app', 'Delete'),
                                //         'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                //         'data-method' => 'post', 'data-pjax' => '0',
                                //         'class' => 'glyphicon glyphicon-pencil btn btn-outline-primary rounded-circle btn-xs button_delete'
                                //     ]);
                                // }
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS

$('#btnTest').on('click', function() {
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
        Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
        )
    }
    })
})

JS;
$this->registerJS($script);
?>