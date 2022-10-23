<?php

/** @var \yii\web\View $this */
/** @var string $content */
$url_web = Yii::getAlias('@web');

use app\assets\FlatepickrAsset;
use app\assets\AdminAsset;
use yii\bootstrap4\Html;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="icon" href="<?= $url_web ?>/template/img/output-onlinepngtools1.png" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body id="themeMode">
    <?php $this->beginBody() ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?= $this->render('sidebar') ?>

        <!-- Content Wrapper -->
        <div class="d-flex flex-column back-light w-100">

            <!-- Main Content -->
            <div id="content">

                <?= $this->render('topbar') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?= $content ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?= $this->render('footer') ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <?= Html::a('Logout', ['default/logout'], ['class' => 'btn btn-primary', 'data' => [
                        'method' => 'post',
                    ]]) ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
$script = <<<JS

    yii.confirm = function (message, okCallback, cancelCallback) {
        var val = $(this).data('value');
        
        if($(this).hasClass('sign-out-user')){
            $.post(val);
        }
    };
JS;
$this->registerJs($script);
?>