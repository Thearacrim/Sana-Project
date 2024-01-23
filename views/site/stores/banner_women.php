    <!-- Start Banner Hero -->

    <?php

    use app\modules\Admin\models\Banner;
use yii\helpers\Url;

    $banners = Banner::find()->where(['banner_type'=>1])->all(); ?>
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="shopping_now">
                                <h1 class="h1 text-success"><b><?= \Yii::t('app', 'NEW') ?></b>
                                    <?= \Yii::t('app', 'IN') ?></h1>
                                <h3 class="h2 text-color mb-5"><?= \Yii::t('app', 'WOMEN') ?>
                                    <?= \Yii::t('app', 'COLLECTION') ?></h3>
                                <a href="<?= Url::to(['site/store-man']) ?>"
                                    class="btn-shopnow"><?= \Yii::t('app', 'SHOP') ?> <?= \Yii::t('app', 'NOW') ?></a>
                            </div>
                        </div>
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last columnBanner" id="zoomIn">
                            <img class="img-banner" src="<?= $base_url ?>/banner/Women_slide2.png" alt="">
                        </div>

                    </div>
                </div>
            </div>
            <?php foreach ($banners as $banner) { ?>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="shopping_now">
                                <h1 class="h1 text-success"><b><?= \Yii::t('app', 'NEW') ?></b>
                                    <?= \Yii::t('app', 'IN') ?></h1>
                                <h3 class="h2 text-color mb-5"><?= \Yii::t('app', 'WOMEN') ?>
                                    <?= \Yii::t('app', 'COLLECTION') ?></h3>
                                <a href="<?= Url::to(['site/store-man']) ?>"
                                    class="btn-shopnow"><?= \Yii::t('app', 'SHOP') ?> <?= \Yii::t('app', 'NOW') ?></a>
                            </div>
                        </div>
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last columnBanner" id="zoomIn">
                            <img class="img-banner" src="<?= $base_url ?>/<?= $banner->image_banner ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a> -->
    </div>
    <!-- End Banner Hero -->