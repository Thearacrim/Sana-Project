    <!-- Start Banner Hero -->

    <?php

    use app\modules\Admin\models\Banner;

    $banners = Banner::find()->all(); ?>
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last columnBanner" id="zoomIn">
                            <img class="img-banner" src="<?= $base_url ?>/template/img/banner_girl.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>NEW</b> IN</h1>
                                <h3 class="h2 text-color">MEN COLLECTION</h3>
                                <button class="btn-shopnow">SHOP NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach ($banners as $banner) { ?>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last columnBanner" id="zoomIn">
                            <img class="img-banner" src="<?= $base_url ?>/<?= $banner->image_banner ?>" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>NEW</b> IN</h1>
                                <h3 class="h2 text-color">MEN COLLECTION</h3>
                                <button class="btn-shopnow">SHOP NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->