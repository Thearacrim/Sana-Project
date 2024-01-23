<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\LoginForm;
use app\models\Product;
use app\modules\Admin\models\OrderItem;
use app\modules\Admin\models\OrderItemSearch;
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
class TopRankController extends Controller
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
    public function actionIndex()
    {
        $orderItem = OrderItem::find()->select('product.status, SUM(order_item.qty) qty')
            ->innerJoin('product', 'product.id = order_item.product_id')
            ->limit(2)
            ->groupBy('product.id')
            ->orderBy('SUM(order_item.qty) DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $orderItem,
            'pagination' => array('pageSize' => 3)
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
