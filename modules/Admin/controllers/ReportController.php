<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\LoginForm;
use app\models\Product;
use app\modules\Admin\models\Invoices;
use app\modules\Admin\models\Order;
use app\modules\Admin\models\OrderItem;
use app\modules\Admin\models\OrderItemSearch;
use app\modules\Admin\models\ProductSearch;
use app\modules\Admin\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Cookie;

/**
 * Default controller for the `admin` module
 */
class ReportController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actions()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'error'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionCustomerRevenueReport()
    {
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        if (!empty($this->request->get('dateRange'))) {
            $dateRange = explode(' - ', $this->request->get('dateRange'));
            if (count($dateRange) >= 2) {
              $fromDate = $dateRange[0];
              $toDate = $dateRange[1];
            }
        }
        $current_user = Yii::$app->user->identity->id;
        $totalPrice = (float) $this->getCartTotalPrice();
        $customer_revenue_report = Yii::$app->db->createCommand("SELECT
        SUM(order_item.price * order_item.qty) price,
        
        `order`.customer_id,	
        customer.`name`
        FROM order_item
        INNER JOIN `order` ON `order`.id = order_item.order_id
        INNER JOIN customer ON customer.id = `order`.customer_id
        where order.created_date between :fromDate and :toDate
        GROUP BY customer_id
        ",[':fromDate' => $fromDate, ':toDate'=>$toDate])
        ->queryAll();
        return $this->render('customer_revenue_report', [
            'customer_revenue_report' => $customer_revenue_report,
            'totalPrice'  => $totalPrice,
            'fromDate' =>$fromDate,
            'toDate' =>$toDate

        ]);
    }
    public function actionProductPerformanceReport()
    {
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        if (!empty($this->request->get('dateRange'))) {
            $dateRange = explode(' - ', $this->request->get('dateRange'));
            if (count($dateRange) >= 2) {
              $fromDate = $dateRange[0];
              $toDate = $dateRange[1];
            }
        }
        $totalPrice = (float) $this->getCartTotalPrice();
        $product_performance_report = Yii::$app->db->createCommand("SELECT
        `order`.customer_id,
        order_item.id id,
        product.`status` status,
        order_item.qty qty,
        order_item.price price
        FROM order_item
        INNER JOIN product ON product.id = order_item.product_id
        INNER JOIN `order` ON `order`.id = order_item.order_id
        INNER JOIN `customer` ON `customer`.id = order.customer_id
        where order.created_date between :fromDate and :toDate
        
        ",[':fromDate' => $fromDate, ':toDate'=>$toDate])
        ->queryAll();
        return $this->render('product_performance_report',[
            'product_performance_report'=> $product_performance_report,
            'totalPrice' => $totalPrice,
            'fromDate' =>$fromDate,
            'toDate' =>$toDate
        ]);
    }
    public function actionSaleReport()
    {
        $fromDate = date('Y-m-d');
        $toDate = date('Y-m-d');
        if (!empty($this->request->get('dateRange'))) {
            $dateRange = explode(' - ', $this->request->get('dateRange'));
            if (count($dateRange) >= 2) {
              $fromDate = $dateRange[0];
              $toDate = $dateRange[1];
            }
        }
        $current_user = Yii::$app->user->identity->id;
        $totalPrice = (float) $this->getCartTotalPrice();
        $sale_report = Yii::$app->db->createCommand("SELECT
        order_item.id id,
        product.`status` status,
        variant_color.color color,
        variant_size.size size,
        order_item.created_date,
        order_item.qty qty,
		`order`.`code` code,
        order_item.price price,
		customer.`name` customer_name
        FROM
        order_item
        INNER JOIN product ON product.id = order_item.product_id
        INNER JOIN variant_color ON variant_color.id = order_item.color
        INNER JOIN variant_size ON variant_size.id = order_item.size
        INNER JOIN `order` ON `order`.id = order_item.order_id
		INNER JOIN customer ON customer.id = `order`.customer_id
        where order.created_date between :fromDate and :toDate
        ",[':fromDate' => $fromDate, ':toDate'=>$toDate])
        ->queryAll();
        return $this->render('sale_report', [
            'sale_report' => $sale_report,
            'totalPrice'  => $totalPrice,
            'fromDate' =>$fromDate,
            'toDate' =>$toDate
        ]);
    }
    private function getCartTotalPrice()
    {
        $current_user = Yii::$app->user->identity->id;
        return Yii::$app->db->createCommand("SELECT
        SUM(order_item.qty * product.price) as price
        FROM order_item
        INNER JOIN product ON product.id = order_item.product_id
        ")->queryScalar();
    }
}
