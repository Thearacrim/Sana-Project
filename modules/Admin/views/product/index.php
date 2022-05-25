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
        ?>
        <?php $this->title = Yii::t('app', 'product'); ?>
        <?php
        $this->params['breadcrumbs'][] = $this->title;


        ?>
        <div class="product-index">

            <h1 class="text-color"><?= Html::encode($this->title) ?></h1>
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
                <div class="card-body back-light">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'id' => 'grid',
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
                                'attribute' => Yii::t('app', 'created_date'),
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Yii::$app->formater->timeAgoKH($model->created_date);
                                }
                            ],
                            [
                                'attribute' => Yii::t('app', 'type'),
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getTypeTemp();
                                }
                            ],
                            // [
                            //     'class' => ActionColumn::class,
                            //     'urlCreator' => function ($action, $model, $key, $index, $column) {
                            //         return Url::toRoute([$action, 'id' => $model->id]);
                            //     },
                            //     'header' => 'action',
                            //     'headerOptions' => ['class' => 'text-center'],
                            //     'contentOptions' => ['class' => 'text-center'],
                            // ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{PDF}{view} {update} {delete}',
                                'visible' => Yii::$app->user->isGuest ? false : true,
                                'buttons' => [
                                    // 'PDF' => function ($url, $model) {
                                    //     return Html::a('<i class="fa-solid fa-file-pdf"></i>', ['/admin/invoices/create-pdf', 'id' => $model->id], [
                                    //         'class' => 'btn btn-outline-info rounded-circle btn-sm',
                                    //         'style' => 'margin-right: 5px;padding:5px 10px',
                                    //         'target' => '_blank',
                                    //         'data-toggle' => 'tooltip',
                                    //         'title' => 'Will open the generated PDF file in a new window'
                                    //     ]);
                                    // },
                                    'view' => function ($url) {
                                        return Html::a('<i class="fa-solid fa-eye"></i>', $url, ['class' => 'btn btn-outline-info rounded-circle btn-sm custom_button']);
                                    },
                                    'update' => function ($url) {
                                        return Html::a('<i class="fa-solid fa-pen-fancy"></i>', $url, ['class' => 'btn btn-outline-info rounded-circle btn-sm custom_button']);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<i class="fa-solid fa-trash-can"></i>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'data-confirm' => 'Are you sure you want to delete this item?',
                                            'data-method' => 'POST',
                                            'class' => 'glyphicon glyphicon-pencil btn btn-outline-info rounded-circle btn-sm button_delete'
                                        ]);
                                    }
                                ],
                                'header' => Yii::t('app', 'action')
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>

    </div>