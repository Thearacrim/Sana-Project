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
        <div class="card back-light p-5" style="box-shadow: 0 0.125rem 0.5rem 0 rgb(0 0 0 / 16%);">
            <div class="product-index">
                <div class="card-header back-light">
                    <h1 class="text-color"><?= Html::encode($this->title) ?></h1>
                </div>
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
                                // 'format' => ['currency'],
                                'value' => function ($model) {
                                    return '$ ' . $model->price;
                                },
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
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{PDF}{view} {update} {delete}',
                                'visible' => Yii::$app->user->isGuest ? false : true,
                                'buttons' => [
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

    <?php
$script = <<<JS
    
    $('.button_delete').click(function(e){
        e.preventDefault();
        var  href = $(this).attr('href');
        Swal.fire({
            title: 'Warning!',
            text: "Are you sure you want to delete this item?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                
            if (result.isConfirmed) {    
                $.post(href)
            }
            })      
    });
        
JS;
$this->registerJS($script);
?>