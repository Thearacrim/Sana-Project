<?php

use backend\models\Invoices;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchInvoices */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoices-index">
    <div class="container">
        <div class="table-me mr-5 ml-5">

            <p>
                <!-- <?= Html::a('Create Invoices', ['create'], ['class' => 'btn btn-success']) ?> -->
            </p>
            <div class="card border-secodary">
                <div class="card-body back-light">
                    <h1 class="text-color"><?= Html::encode($this->title) ?></h1>
                    <?php echo $this->render('_search', ['model' => $searchModel]);
                    ?>

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

                            [
                                'attribute' => 'customer_id',
                                'value' => 'customer.name'
                            ],
                            [
                                'attribute' => 'Issue_date',
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Yii::$app->formater->timeAgo($model->Issue_date);
                                }
                            ],
                            [
                                'attribute' => 'Due_date',
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Yii::$app->formater->timeAgo($model->Due_date);
                                }
                            ],
                            'Type',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getStatus();
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{PDF}{view} {update} {delete}',
                                'visible' => Yii::$app->user->isGuest ? false : true,
                                'buttons' => [
                                    'PDF' => function ($url, $model) {
                                        return Html::a('<i class="fa-solid fa-file-pdf"></i>', ['/admin/invoices/create-pdf', 'id' => $model->id], [
                                            'class' => 'btn btn-outline-info rounded-circle btn-sm',
                                            'style' => 'margin-right: 5px;padding:5px 10px',
                                            'target' => '_blank',
                                            'data-toggle' => 'tooltip',
                                            'title' => 'Will open the generated PDF file in a new window'
                                        ]);
                                    },
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
                                'header' => 'action',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>