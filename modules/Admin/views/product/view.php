<?php
$base_url = Yii::getAlias('@web');

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$updated = Yii::$app->session->hasFlash('success') ? 1 : 0;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-left">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="card border-secondary rounded-0" style="width: 20rem;">
        <img src="<?= Yii::getAlias('@web') ?>/<?= $model->image_url ?>" class="card-img-top" style="height:300px;padding:20px">
        <div class="card-body back-light text-color">
            <h5 class="card-title"><?= $model->status ?></h5>
            <p class="card-text"><?= $model->description ?></p>
            <h4 class="fw-bold text-dark">$<?= $model->price ?></h4>
        </div>
    </div>
</div>

<?php
$script = <<< JS
    if($updated)
    {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
        })
    }
    JS;
$this->registerJS($script);
?>