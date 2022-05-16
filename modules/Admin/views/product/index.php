    <div class="table-me mr-5 ml-5">

        <?php

        use yii\bootstrap4\LinkPager;
        use yii\bootstrap4\Modal;
        use yii\helpers\Html;
        use yii\helpers\Url;
        use yii\grid\ActionColumn;
        use yii\grid\GridView;
        use yii\widgets\LinkPager as WidgetsLinkPager;

        /* @var $this yii\web\View */
        /* @var $searchModel backend\models\ProductSearch */
        /* @var $dataProvider yii\data\ActiveDataProvider */

        $this->title = 'Products';
        $this->params['breadcrumbs'][] = $this->title;


        ?>
        <div class="product-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php
            Modal::begin([
                'title' => 'Create new Product',
                'id' => 'modal',
                'size' => 'modal-lg',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();
            ?>
            <?php echo $this->render('_search', ['model' => $searchModel, 'class' => 'form-control inp rounded-0']); ?>
            <div class="card">
                <div class="card-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'grid',
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
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'contentOptions' => [
                                    'style' => 'width:60px;'
                                ]
                            ],
                            'status',
                            [
                                'attribute' => 'price',
                                'format' => ['currency'],
                                'contentOptions' => [
                                    'style' => 'width:100px;'
                                ]
                            ],
                            [
                                'attribute' => 'created_date',
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Yii::$app->formater->timeAgoKH($model->created_date);
                                }
                            ],
                            [
                                'attribute' => 'type',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getTypeTemp();
                                }
                            ],
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'header' => 'action',
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                            ],
                            // [
                            //     'class' => 'yii\grid\ActionColumn',
                            //     // 'contentOptions' => ['style' => 'width: 7%'],
                            //     'visible' => Yii::$app->user->isGuest ? false : true,
                            //     'buttons' => [
                            //         'view' => function ($url) {
                            //             return Html::a('<i class="fa-solid fa-eye"></i>', $url, ['class' => 'glyphicon glyphicon-eye-open btn btn-outline-info btn-sm rounded-circle btn-xs custom_button']);
                            //         },
                            //         'update' => function ($url) {
                            //             return Html::a('<i class="fa-solid fa-pen-fancy"></i>', $url, ['class' => 'glyphicon glyphicon-pencil btn btn-outline-info btn-sm rounded-circle btn-xs custom_button']);
                            //         },
                            //         'delete' => function ($url) {
                            //             return Html::a('<i class="fa-solid fa-trash-can"></i>', $url, [
                            //                 'title' => Yii::t('app', 'Delete'),
                            //                 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                            //                 'data-method' => 'post', 'data-pjax' => '0',
                            //                 'class' => 'glyphicon glyphicon-pencil btn btn-outline-info btn-sm rounded-circle btn-xs button_delete'
                            //             ]);
                            //         }
                            //     ],
                            // ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>

    </div>