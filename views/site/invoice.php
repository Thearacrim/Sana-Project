<?php

use app\models\Invoices;
use app\models\Order;
use app\models\OrderItem;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

// $dataProvider = new ActiveDataProvider([
//     'query' => OrderItem::find()->where(['order_id' => $id]),
// ]);
// $order_item = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM `order_item` 
//     where order_id = :id")
//     ->bindParam("id", $id)
//     ->queryOne();
// $order = Order::find()->one();
// $customer = Yii::$app->db->createCommand("SELECT 
//  customer.name,
//  customer.address 
//  FROM `zay_store`.invoices
//     INNER JOIN customer on invoices.Customer = customer.id  
//     where invoices.id = :id")
//     ->bindParam("id", $id)
//     ->queryOne();
// $invoice = Invoices::find()->one();
?>
<div class="card rounded-0 back-light">
    <h1>hi</h1>
</div>