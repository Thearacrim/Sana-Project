<?php

use backend\models\Order;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-index">
    <div class="table-me mr-5 ml-5">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="card">
            <div class="card-body">

                <!-- <p>
            <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
        </p> -->
                <?php echo $this->render('_search', ['model' => $searchModel, 'class' => 'form-control inp rounded-0']); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => [
                        'class' => 'table table-hover text-dark',
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
                            {summary}
                        </div>
                        <div class='col-md-6'>
                            {pager}
                        </div>
                    </div>
                ",
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'code',
                        [
                            'attribute' => 'customer_id',
                            'value' => 'order.name'
                        ],
                        // [
                        //     'attribute' => 'sub_total',
                        //     'format' => ['currency'],
                        //     'contentOptions' => [
                        //         'style' => 'width:100px;'
                        //     ]
                        // ],
                        //'discount',
                        // 'grand_total',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->getTypeTemp();
                            }
                        ],
                        [
                            'attribute' => 'created_date',
                            'value' => function ($model) {
                                return Yii::$app->formater->timeAgoKH($model->created_date);
                            }
                        ],
                        //'created_by',
                        // [
                        //     'class' => ActionColumn::className(),
                        //     'urlCreator' => function ($action, Order $model, $key, $index, $column) {
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
                                'delete' => function ($url) {
                                    return Html::a('<i class="fa-solid fa-trash-can"></i>', $url, [
                                        'title' => Yii::t('app', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                                        'data-method' => 'post', 'data-pjax' => '0',
                                        'class' => 'glyphicon glyphicon-pencil btn btn-outline-info btn-sm rounded-circle btn-xs button_delete'
                                    ]);
                                }
                            ],
                        ],
                    ],
                ]);
                // echo Yii::$app->user->isGuest ? "yes" : "no";
                ?>


            </div>
        </div>
    </div>
</div>

<?php

$script = <<< JS
        $('.button_delete').click(function(){
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
                title: 'Delete successfully'
                })
        })
    JS;
$this->registerJs($script);

?>