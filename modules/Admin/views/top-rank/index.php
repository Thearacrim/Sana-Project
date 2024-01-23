<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Top Rank'); ?>
<?php
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-me mr-5 ml-5 mb-5">
    <h1 class="text-color"><?= Html::encode($this->title) ?></h1>
    <div class="card">
        <div class="card-body back-light" style="box-shadow: 0 0.125rem 0.5rem 0 rgb(0 0 0 / 16%);">
            <!-- <p>
            <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
        </p> -->
            <!-- <? //echo $this->render('_search', ['model' => $searchModel, 'class' => 'form-control inp rounded-0']);
                    ?> -->

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'id' => 'grid',
                'tableOptions' => [
                    'class' => 'table table-hover text-color',
                    'cellspacing' => '0',
                    'width' => '100%',
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
                    'qty',
                    [
                        'attribute' => 'Championship',
                        'format' => 'html',
                        'value' => function ($model) {
                            return
                                Html::img(
                                    $model->Championship,
                                    [
                                        'width' => '25px',
                                        'height' => '30px',
                                    ]
                                );
                        }
                    ]
                ],
            ]); ?>

        </div>
    </div>
</div>