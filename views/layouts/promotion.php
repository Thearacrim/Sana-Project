<?php

use app\modules\Admin\models\Coupon;
?>
<?php $discount = Yii::$app->db->createCommand("SELECT
        discount, expire_date
    FROM
        `coupon` 
    WHERE
    CURDATE() < expire_date
            ")
    ->queryOne();
$time = new \DateTime('now');
$today = $time->format('Y-m-d');
// $expire = Coupon::find()->where(['>=', 'expire_date', $time])->one();
$expire = Yii::$app->db->createCommand("SELECT
     expire_date
    FROM
        `coupon` 
    WHERE
    expire_date > :today
            ")
    ->bindParam('today', $today)
    ->queryScalar();
?>
<?php if ($discount) { ?>
    <div class="">
        <div class="alert alert-success alert-dismissible fade show navbar-expand-lg navbar navbar-expand-lg mb-0" role="alert">
            <div style="margin:0 auto;">
                <span style="font-size:2rem; font-weight:800"><?= $discount['discount'] ?>%</span> <span class="fw-bold">Big Promotion!</span> Check Our Product to get more available.
                <span id="demo" style="font-size:2rem; font-weight:800">
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php
} else { ?>

<?php } ?>
<?php
if ($expire > $today) {
    $expire = $discount['expire_date'] > $today ? $discount['expire_date'] : '2022-06-08 00:00:00';
} else {
    $expire = '2022-06-08 00:00:00';
}
?>
<?php
$script = <<< JS
    var expire= "$expire";
    
    var countDownDate = new Date(expire).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
        
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
        
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
    // Output the result in an element with id="demo"
    // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
        
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        // document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);
    JS;
$this->registerJs($script);


?>