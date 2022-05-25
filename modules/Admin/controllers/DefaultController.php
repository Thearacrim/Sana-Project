<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\LoginForm;
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

    public function actionIndex()
    {
        return $this->render('index');
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
        Yii::$app->setHomeUrl(Yii::getAlias("@web/index.php?r=admin/default"));
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
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
        Yii::$app->setHomeUrl(Yii::getAlias("@web/index.php?r=admin/default/login"));
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
