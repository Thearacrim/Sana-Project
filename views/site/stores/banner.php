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
              <div class="mx-auto col-md-8 col-lg-6 order-lg-last column" id = "zoomIn">
                <img class="img-fluid" src="<?= $base_url ?>/template/img/banner_img_01.png" alt="">
              </div>
              <div class="col-lg-6 mb-0 d-flex align-items-center">
                <div class="text-align-left align-self-center">
                  <h1 class="h1 text-success"><b>Zay</b> eCommerce</h1>
                  <h3 class="h2 text-color">Tiny and Perfect eCommerce Template</h3>
                  <p class="text-color">
                    Zay Shop is an eCommerce HTML5 CSS template with latest version of Bootstrap 5 (beta 1).
                    This template is 100% free provided by <a rel="sponsored" class="text-success" href="https://templatemo.com" target="_blank">TemplateMo</a> website.
                    Image credits go to <a rel="sponsored" class="text-success" href="https://stories.freepik.com/" target="_blank">Freepik Stories</a>,
                    <a rel="sponsored" class="text-success" href="https://unsplash.com/" target="_blank">Unsplash</a> and
                    <a rel="sponsored" class="text-success" href="https://icons8.com/" target="_blank">Icons 8</a>.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php foreach ($banners as $banner) { ?>
          <div class="carousel-item">
            <div class="container">
              <div class="row p-5">
                <div class="mx-auto col-md-8 col-lg-6 order-lg-last column" id = "zoomIn">
                  <img class="img-fluid" src="<?= $base_url ?>/<?= $banner->image_banner ?>" alt="">
                </div>
                <div class="col-lg-6 mb-0 d-flex align-items-center">
                  <div class="text-align-left align-self-center">
                    <h1 class="h1 text-success text-color"><b>Zay</b> <?= $banner->title ?></h1>
                    <h3 class="text-color"><?= $banner->sort_description ?></h3>
                    <p class="text-color">
                      <?= $banner->description ?><a rel="sponsored" class="text-success" href="https://templatemo.com" target="_blank">TemplateMo</a> website.
                      Image credits go to <a rel="sponsored" class="text-success" href="https://stories.freepik.com/" target="_blank">Freepik Stories</a>,
                      <a rel="sponsored" class="text-success" href="https://unsplash.com/" target="_blank">Unsplash</a> and
                      <a rel="sponsored" class="text-success" href="https://icons8.com/" target="_blank">Icons 8</a>.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
      </a>
      <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>
    <!-- End Banner Hero -->