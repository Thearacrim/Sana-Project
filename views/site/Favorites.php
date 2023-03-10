<?php

use app\models\Product;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\helpers\Html;

$isFav = !empty($model->favorite)?'isFav':'';
$base_url = Yii::getAlias("@web");
$discount = Yii::$app->db->createCommand("SELECT
        discount
    FROM
        `coupon` 
    WHERE
    CURDATE() < expire_date
            ")
    ->queryScalar();
?>
<style>
.list-unstyled {
    margin-left: 135px;
    position: absolute;
    top: 102px;
    right: 72px;
}

.m-left {
    border-radius: 37px;
}

.btn-remove-item {
    width: 30px;
    position: absolute;
    border-radius: 50%;
    right: 10px;
    top: 8px;
}

.isFav:hover {
    background-color: #000;
    color: #fff;
}

.isFav {
    background-color: #000;
    color: #fff;
}
</style>

<br>
<br>
<br>

<div class="container">
    <section class="py-5">
        <div class="row">
            <?php foreach ( $favorites as $key => $value) { ?>
            <div class="col-lg-2 mb-5 product-item row_item_<?= $value['id']?>">
                <div class="card h-100 shadow">
                    <?php echo Html::a(
                  '<i class="fa fa-times"></i>',
                  ['remove', 'id' => $value['id']],
                  [
                      'class' => 'btn btn-danger btn-sm  btn-remove-item warning',
                      'date-method' => 'POST', 'data-id' => $value['id']
                  ]
              ) ?>
                    <a href="<?= Url::to(['store-single', 'id' => $value['id']]) ?>">
                        <img class="card-img-top" src="<?= $base_url . '/' . $value['image_url'] ?>">
                    </a>
                    <div class="card-body">
                        <div>
                            <p class="card-text"><?= $value['status']?></p>
                            <h6>
                            </h6>
                            <p class="card-text font-weight-bold">$<?= $value['price']?></p>
                        </div>
                    </div>

                </div>
            </div>
            <?php } ?>
        </div>

    </section>
</div>

<br>
<br>
<div class="container">
    <div class="clearfix">
        <h2 class="d-flex justify-content-center">RECOMMENDED FOR YOU </h2>
        <hr>
    </div>
    <div class="container">
        <section class="py-5">
            <div class="row ">
                <?php foreach ($products as $key => $value) { ?>
                <div class="col-lg-2 mb-5 product-item">
                    <div class="card h-100 shadow">
                        <ul class="list-unstyled">
                            <li>
                                <a class="btn btn-danger btn-sm text-white btn-add-to-fav product-item  <?= $isFav?>"
                                    href="#" data-id="<?=$value->id?>"><i class="far fa-heart"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-danger btn-sm text-white mt-2"
                                    href="<?= Url::to(['store-single', 'id' => $value->id]) ?>"><i
                                        class="far fa-eye"></i></a>
                            </li>
                        </ul>
                        <a href="<?= Url::to(['store-single', 'id' => $value['id']]) ?>">
                            <img class="card-img-top" src="<?= $base_url . '/' . $value['image_url'] ?>">
                        </a>
                        <div class="card-body">
                            <p class="card-text"><?= $value['status']?></p>
                            <p class="card-text font-weight-bold">$<?= $value['price']?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="text-center">
                <a class="btn btn-primary btn-sm btn-add-to-cart rounded-0"
                    href="<?= Url::to(['site/add-cart']) ?>"></i>Learn
                    More</a>
            </div>
        </section>
    </div>
</div>

</div>
<br>
<br>
<?php
$add_fav_url = Url::to(['site/favorites']);
$add_cart_url = Url::to(['site/remove-fav']);
$script = <<<JS
    // btn-remove section
        $('.btn-remove-item').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '',
                method: 'POST',
                data: {
                    url: "$add_cart_url" ,
                    id: id,
                    action: 'remove_fav',
                },
                success: function(res){
                    var data = JSON.parse(res);
                    console.log(data);
                    if(data['status'] == 'success'){
                        $(".row_item_"+id).remove();
                        $("#favortie-quantity").text(data['favoritestotal']);
                    }
                },
                error: function(err){
                    console.log(err);
                }
        });
    });
     $(".btn-add-to-fav").click(function(e){
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: "$add_fav_url",
            method: 'POST',
            data: {
                action: 'btn-add-to-fav',
                id: id,
            },
            success: function(res){
                var data = JSON.parse(res);
                console.log(data)
                if(data['status'] == 'success'){

                    $("#favortie-quantity").text(data['favoritestotal']);
                    if (data['type'] == 'remove'){
                        $(".btn-add-to-fav[data-id='"+id+"']").removeClass("isFav");
                    }else {
                        $(".btn-add-to-fav[data-id='"+id+"']").addClass("isFav");
                    }
                    
                }else{
                    alert(data['message']);
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    });
JS;
$this->registerJs($script);

?>