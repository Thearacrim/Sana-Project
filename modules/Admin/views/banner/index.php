<?php

use app\modules\Admin\models\Banner;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$base_url_frontend = str_replace("backend", 'frontend', Yii::$app->request->baseUrl);
$banners = Banner::find()->all();
$base_url = Yii::getAlias('@web');

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .row_gallery .card {
        margin-bottom: 0;
    }

    .row_gallery img {
        width: 100%;
        border-radius: 4px;
    }

    .row_gallery .carousel-caption {
        top: 25%;
        transform: translateY(-50%);
        bottom: initial;
        opacity: 0;
        transition: .5s ease;
    }

    .row_gallery .gallery-image:hover .carousel-caption {
        opacity: 1;
    }

    .row_gallery .gallery-image img {
        height: 300px;
        object-fit: cover;
    }

    .row_gallery .gallery-image:hover img {
        opacity: .8;
        transition: .3s ease;
    }

    .row_gallery .add-button i {
        font-size: 3rem;
        color: #000;
        opacity: .4;
    }

    .row_gallery .col:hover .add-button i {
        opacity: .8;
        cursor: pointer;
    }

    .row_gallery .col-lg-4 {
        padding-bottom: 1rem;
    }
</style>
<div class="banner-index">

    <h1 class="text-color"><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="cart-body m-5">

        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>
        <div class="row row_gallery">
            <?php foreach ($banners as $banner) { ?>
                <input style="position: absolute; z-index: -999; opacity: 0;" id="url_hidden_<?= $banner->id ?>" value="<?= $banner->image_banner ?>">
                <div class="col-lg-4">
                    <div class="card h-100 text-color back-light">
                        <div class="gallery-image">
                            <img src="<?= $base_url_frontend ?>/<?= $banner->image_banner ?>" style="height:200px;padding:20px">
                            <div class="carousel-caption">
                                <button type="button" data-bs-toggle="tooltip" title="Copy URL" data-bs-placement="bottom" data-id="<?= $banner->id ?>" class=" btn btn-secondary btn-icon linkToCopy rounded-circle action_copy_<?= $banner->id ?>" id="action_copy"><i class="fas fa-link"></i></button>
                                <a href="<?= Url::to(['/admin/banner/update', 'id' => $banner->id]) ?>" data-bs-toggle="tooltip" title="Update" data-bs-placement="bottom" data-title="Update gallery image: <?= $banner->title ?>" value="" class="btn rounded-circle btn-secondary btn-icon modalButton"><i class="fa-regular fa-pen-to-square"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $banner->title ?></h5>
                            <p class="card-text"><?= $banner->sort_description ?></p>
                            <p class="card-text"><?= $banner->description ?></p>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
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

                            'title',
                            'sort_description',
                            'image_banner',
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, Banner $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?> -->

        </div>
    </div>
</div>
<?php
$script = <<<JS

    // Copy URL
    $(".linkToCopy").click(function(){
      var id = $(this).data("id");
      $("#url_hidden_"+id).select();
      document.execCommand("copy");
        $(".action_copy_"+id).attr('data-original-title', 'Copied');
        $(".action_copy_"+id).tooltip('show');
    });

    // Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    // // change Tooltip when clicked copy
    // $("#action_copy").click(function(){
    //     $("#action_copy").attr('data-original-title', 'Copied');
    // });
    JS;
$this->registerJs($script);
?>