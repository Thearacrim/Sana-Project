    <div class="table-me mr-5 ml-5">
        <?php

        use app\modules\Admin\models\Coupon;
        use yii\bootstrap4\ActiveForm;
        use yii\bootstrap4\LinkPager;
        use yii\helpers\Html;
        use yii\helpers\Url;
        use yii\grid\ActionColumn;
        use yii\grid\GridView;

        /* @var $this yii\web\View */
        /* @var $searchModel app\modules\admin\models\CouponSearch */
        /* @var $dataProvider yii\data\ActiveDataProvider */

        $this->title = 'Coupons';
        $this->params['breadcrumbs'][] = $this->title;
        ?>
        <div class="coupon-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <!-- 
            <p>
                <?= Html::a('Create Coupon', ['create'], ['class' => 'btn btn-success']) ?>
            </p> -->

            <?php echo $this->render('_search', ['model' => $searchModel]);
            ?>
            <div class="ml-3">
                <p>
                    <button class="btn btn-primary float-right btn1 rounded-circle action" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-plus"></i></button>
                <div class="offcanvas offcanvas-end back-light" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body back-light">
                        <?php $form = ActiveForm::begin(['action' => ['/admin/coupon/create'], 'method' => 'POST']); ?>
                        <?= $form->field($model, 'coupon_title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

                        <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true, 'placeholder' => 'Code']) ?>

                        <?= $form->field($model, 'discount')->textInput(['maxlength' => true, 'placeholder' => 'Discount']) ?>

                        <?= $form->field($model, 'discount_on')->dropDownList(['all product' => 'All product', 'clothes' => 'Clothes', 'shoes' => 'Shoes', '' => '',], ['prompt' => 'Discount On']) ?>

                        <?= $form->field($model, 'coupon_type')->dropDownList(['percentage' => 'Percentage', 'amount' => 'Amount',], ['prompt' => 'Coupon Type']) ?>

                        <div class="form-group">
                            <label for="expire_date">Expire Date</label>
                            <input type="hidden" class="form-control flatpickr flatpickr-input" id="expire_date" name="Coupon[expire_date]" placeholder="Expire Date" required="">
                        </div>

                        <?= $form->field($model, 'status')->dropDownList(['public' => 'Public', 'draft' => 'Draft',], ['prompt' => 'Status']) ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-primary rounded-0 w-75']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                </p>
            </div>
            <div class="card">
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
                            'coupon_code',
                            [
                                'attribute' => 'discount',
                                'value' => function ($model) {
                                    return $model->discount . "%";
                                }
                            ],
                            'discount_on',
                            [
                                'attribute' => Yii::t('app', 'expire_date'),
                                'headerOptions' => ['class' => 'text-center'],
                                'contentOptions' => ['class' => 'text-center'],
                                'value' => function ($model) {
                                    return Yii::$app->formater->date($model->expire_date);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getTypeStatus();
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
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