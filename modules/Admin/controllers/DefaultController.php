<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\LoginForm;
use app\modules\Admin\models\SignupForm;
use app\modules\Admin\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Cookie;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
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

    public function actionLanguage()
    {
        $language = Yii::$app->request->post('language');
        Yii::$app->language = $language;

        $languageCookie = new Cookie([
            'name' => 'lang',
            'value' => $language,
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($languageCookie);

        $localeCookie = new yii\web\Cookie([
            'name' => 'locale',
            'value' => 'Kh-KM',
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($localeCookie);

        $calendarCookie = new yii\web\Cookie([
            'name' => 'calendar',
            'value' => 'en-US',
            'expire' => time() + 60 * 60 * 24 * 30, // 30 days
        ]);
        Yii::$app->response->cookies->add($calendarCookie);
    }

    private function GetMonth($month)
    {
        $total = Yii::$app->db->createCommand("SELECT
            sum( qty * price ) AS Total
        FROM
            order_item
        WHERE
            MONTH ( created_date ) = $month
        GROUP BY
            MONTH ( created_date )
            ")
            ->queryScalar();
        return $total ? $total : 0;
    }

    public function actionIndex()
    {
        $totalUser =
            Yii::$app->db->createCommand("SELECT
            COUNT(id) as totalUser
            FROM user

            ")
            ->queryOne();

        $totalProduct =
            Yii::$app->db->createCommand("SELECT
            COUNT(id) as totalProduct
            FROM product

            ")
            ->queryOne();
        $totalCustomer =
            Yii::$app->db->createCommand("SELECT
            COUNT(id) as totalCustomer
            FROM customer
            ")
            ->queryOne();

        $findPriceApril = $this->GetMonth(4);
        $findPriceMay = $this->GetMonth(5);
        $findPriceJune = $this->GetMonth(6);
        $findPriceJuly = $this->GetMonth(7);
        $findPriceAugust = $this->GetMonth(8);
        $findAnnualPrice =
            Yii::$app->db->createCommand("SELECT
                SUM(qty * price) as TotalAnnual
            FROM
                order_item
            ")
            ->queryScalar();
        return $this->render('index', [
            'findPriceApril' => $findPriceApril,
            'findPriceMay' => $findPriceMay,
            'findPriceJune' => $findPriceJune,
            'findPriceJuly' => $findPriceJuly,
            'findPriceAugust' => $findPriceAugust,
            'findAnnualPrice' => $findAnnualPrice,
            'totalUser' => $totalUser,
            'totalProduct' => $totalProduct,
            'totalCustomer' => $totalCustomer,
        ]);
    }

    public function beforeAction($action)
    {
        Yii::$app->setHomeUrl(Yii::getAlias("@web/index.php?r=admin/default"));
        if ($action->id == 'error') {
            $this->layout = 'error';
        }
        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        // set this to use default
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->login();
            return $this->goBack();
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignUp()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->setHomeUrl(Yii::getAlias("@web/index.php?r=admin/default/login"));
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */

    public function actionLogout()
    {
        // Set to default url
        Yii::$app->session->setFlash('logout', "Logout in Successfully");
        Yii::$app->setHomeUrl(Yii::getAlias("@web/index.php?r=admin/default/login"));
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
