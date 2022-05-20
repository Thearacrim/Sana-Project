<?php
$base_url = Yii::getAlias('@web');

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$frontend_url = str_replace("backend", 'frontend', Yii::$app->request->baseUrl);
/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-left">
        <a class='btn btn-primary' href="<?= Url::to(['/product']) ?>">Home</a>
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
        <img src="<?= $frontend_url ?>/frontend/<?= $model->image_url ?>" class="card-img-top" style="height:300px;padding:20px">
        <div class="card-body back-light text-color">
            <h5 class="card-title"><?= $model->status ?></h5>
            <p class="card-text"><?= $model->description ?></p>
            <h4 class="fw-bold text-dark">$<?= $model->price ?></h4>
        </div>
    </div>
</div>