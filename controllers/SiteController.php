<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Cart;
use app\models\Favorite;
use app\models\ResendVerificationEmailForm;
use app\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\Customer;
use app\models\Order;
use app\models\OrderItem;
use app\models\Product;
use app\models\ProductSearch;
use app\models\SaveLater;
use app\models\User;
use app\modules\Admin\models\Coupon;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use app\components\AuthHandler;
use yii\bootstrap4\ActiveForm;
use app\components\AuthHandles;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],

            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],

        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'error') {
            $this->layout = 'error';
        }
        return parent::beforeAction($action);
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
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->get('ProductSearch')) {
            return $this->redirect(['site/search', 'ProductSearch' => Yii::$app->request->get('ProductSearch')]);
        }
        $this->layout = 'home';
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->all(),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => Product::find()->where(['type_item' => 2]),
        ]);
        $shoes = Product::find()->where(['type_item' => '6'])->one();
        $watch = Product::find()->where(['type_item' => '5'])->one();
        $man = Product::find()->where(['type_item' => '2'])->one();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProvider1'=>$dataProvider1,
            'shoes' => $shoes,
            'man' => $man,
            'watch' => $watch
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */

    public function actionLogin()
    {
        //Action Login
        $model = new LoginForm();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                // Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->redirect(['site/add-cart']);
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/add-cart']);
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['Verify'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionChangeQuantity()
    {
        if ($this->request->isAjax) {
            if ($this->request->post('action') == 'item-quantity') {
                $id = $this->request->post('id');
                $type = $this->request->post('type');
                $current_user = Yii::$app->user->identity->id;
                $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $current_user])
                    ->one();
                if ($cart) {
                    if ($type == 'add') {
                        $cart->quantity++;
                    } else {
                        if ($cart->quantity == 1) {
                            $cart->quantity = 1;
                        } else {
                            $cart->quantity--;
                        }
                    }

                    if ($cart->save()) {
                        $coupon = Yii::$app->db->createCommand(
                            "SELECT
                            id
                        FROM
                            `coupon` 
                        WHERE
                        CURDATE() < expire_date "
                        )->queryScalar();
                        $totalCart = Cart::find()
                            ->select(['SUM(quantity) quantity'])
                            ->where(['user_id' => $current_user])
                            ->one();
                        $totalCart = $totalCart->quantity;
                        if($coupon){
                            $totalPrice_in_de_remove = Yii::$app->db->createCommand(
                                "SELECT 
                        SUM( cart.quantity * (product.price - (product.price * (coupon.discount / 100)))) as total_price
                            FROM cart
                            INNER JOIN product ON product.id = cart.product_id
                            INNER JOIN coupon ON coupon.id = cart.coupon_id 
                            WHERE cart.coupon_id = :coupon AND coupon.expire_date > CURDATE()
                        "
                            )
                                ->bindParam('coupon', $coupon)
                                ->queryScalar();
                        }else{
                            $totalPrice_in_de_remove = Yii::$app->db->createCommand("SELECT 
                        SUM( cart.quantity * (product.price)) as total_price
                            FROM cart
                            INNER JOIN product ON product.id = cart.product_id
                            WHERE cart.user_id = :userId
                        ")
                            ->bindParam('userId', $current_user)
                                ->queryScalar();
                        }
                        return json_encode(['status' => 'success', 'totalCart' => $totalCart, 'totalPrice_in_de_remove' => $totalPrice_in_de_remove]);
                    } else {
                        return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
                    }
                }
            }
        }
    }

    public function actionCart()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        if ($this->request->isAjax) {
            if ($this->request->post('action') == 'btn_remove_item') {
                $id = $this->request->post('id');
                $current_user = Yii::$app->user->identity->id;
                if (Cart::findOne($id)->delete()) {
                    $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $current_user])->one();
                    $totalCart = $totalCart->quantity;
                    $coupon = Yii::$app->db->createCommand(
                        "SELECT
                        id
                    FROM
                        `coupon` 
                    WHERE
                    CURDATE() < expire_date "
                    )->queryScalar();
                    $totalItem = Cart::find()->select(['user_id'])->where(['user_id' => $current_user])->count();
                    if($coupon){
                    $totalPrice_in_de_remove = Yii::$app->db->createCommand(
                        "SELECT 
                    SUM( cart.quantity * (product.price - (product.price * (coupon.discount / 100)))) as total_price
                        FROM cart
                        INNER JOIN product ON product.id = cart.product_id
                        INNER JOIN coupon ON coupon.id = cart.coupon_id 
                        WHERE cart.coupon_id = :coupon AND coupon.expire_date > CURDATE()
                    "
                    )
                        ->bindParam('coupon', $coupon)
                        ->queryScalar();
                    }else{
                        $totalPrice_in_de_remove = Yii::$app->db->createCommand("SELECT 
                    SUM( cart.quantity * (product.price)) as total_price
                        FROM cart
                        INNER JOIN product ON product.id = cart.product_id
                        WHERE cart.user_id = :userId
                    ")
                            ->bindParam('userId', $current_user)
                            ->queryScalar();
                    }
                    $available_item = "There are no items available";
                    return json_encode(['status' => 'success', 'totalCart' => $totalCart, 'totalItem' => $totalItem, 'totalPrice_in_de_remove' => $totalPrice_in_de_remove, 'available_item' => $available_item]);
                }
            } else if ($this->request->post('action') == 'save_for_later') {
                $id = $this->request->post('id');
                $save_id = $this->request->post('save_id');
                $current_user = Yii::$app->user->identity->id;
                $save_later = SaveLater::find()->where(['user_id' => $current_user, 'product_id' => $save_id])->one();
                if (Cart::findOne($id)->delete()) {
                    $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $current_user])->one();
                    $totalCart = $totalCart->quantity;
                    $coupon = Yii::$app->db->createCommand(
                        "SELECT
                            id
                        FROM
                            `coupon` 
                        WHERE
                        CURDATE() < expire_date "
                    )->queryScalar();
                    $totalPrice_in_de_remove = Yii::$app->db->createCommand("SELECT 
                        SUM( cart.quantity * (product.price - (product.price * (coupon.discount / 100)))) as total_price
                        FROM cart
                        INNER JOIN product ON product.id = cart.product_id
                        INNER JOIN coupon ON coupon.id = cart.coupon_id 
                        WHERE user_id = :userId
                    ")
                        ->bindParam("userId", $current_user)
                        ->queryScalar();
                    if (!$save_later) {
                        $save_later = new SaveLater();
                        $save_later->product_id = $save_id;
                        $save_later->user_id = $current_user;
                    }
                    if ($save_later->save()) {
                        $product_save_later = Yii::$app->db->createCommand(
                            "SELECT product.id as id, product.status as status, product.price as price, product.image_url as image_url,save_later.user_id as user_id FROM `product`
                            INNER JOIN save_later ON save_later.product_id = product.id
                            WHERE user_id = :user_id
                            "
                        )
                            ->bindParam("user_id", $current_user)
                            ->queryAll();
                        $result = [];
                        foreach ($product_save_later as $product_save) {
                            $result[] = [
                                'id' => $product_save['id'],
                                'url' => $product_save['image_url'],
                                'status' => $product_save['status'],
                                'price' => $product_save['price']
                            ];
                        }
                        return json_encode([
                            'status' => 'success',
                            'totalPrice_in_de_remove' => $totalPrice_in_de_remove,
                            'product_save_later' => $result,
                            'totalCart' => $totalCart,
                        ]);
                    }
                }
            } else if ($this->request->post('action') == 'move-to-cart') {
                $id = $this->request->post('save_id');
                if (SaveLater::find()->where(['product_id' => $id])->one()->delete()) {
                    return json_encode(['status' => 'success']);
                }
            }
        }

        $userId = Yii::$app->user->id;
        $relatedProduct = Yii::$app->db->createCommand(
            "SELECT product.*,cart.color_id, cart.size_id, cart.quantity, cart.id AS cart_id, variant_size.size, variant_color.color  FROM cart
            INNER JOIN product ON product.id = cart.product_id
            INNER JOIN variant_size ON variant_size.id = cart.size_id
            INNER JOIN variant_color ON variant_color.id = cart.color_id
            WHERE cart.user_id = :userId "
        )
            ->bindParam('userId', $userId)
            ->queryAll();
        $product_save_later = Yii::$app->db->createCommand(
            "SELECT product.* FROM save_later
            INNER JOIN product ON product.id = save_later.product_id
            WHERE save_later.user_id = :userId "
        )
            ->bindParam('userId', $userId)
            ->queryAll();
        $current_user = Yii::$app->user->id;
        $totalCart = Cart::find()->select(['user_id'])->where(['user_id' => $current_user])->count();
        $coupon = Yii::$app->db->createCommand(
            "SELECT
                id
            FROM
                `coupon` 
            WHERE
            CURDATE() < expire_date "
        )->queryScalar();
        if($coupon){
            $totalPrice = Yii::$app->db->createCommand("SELECT 
               SUM( cart.quantity * (product.price - (product.price * (coupon.discount / 100)))) as total_price
                FROM cart
                INNER JOIN product ON product.id = cart.product_id
                INNER JOIN coupon ON coupon.id = cart.coupon_id 
                WHERE cart.coupon_id = :coupon AND coupon.expire_date > CURDATE()
            ")
            ->bindParam('coupon', $coupon)
            ->queryScalar();
        }else{
            $totalPrice = Yii::$app->db->createCommand("SELECT 
               SUM( cart.quantity * (product.price)) as total_price
                FROM cart
                INNER JOIN product ON product.id = cart.product_id
                WHERE cart.user_id = :userId
            ")
            ->bindParam('userId', $userId)
            ->queryScalar();
        }
        $products = Product::find()->all();
        return $this->render(
            'cart',
            [
                'relatedProduct' => $relatedProduct,
                'products' => $products,
                'totalPrice' => $totalPrice,
                'totalCart' => $totalCart,
                'product_save_later' => $product_save_later
            ]
        );
    }

    public function actionSearch()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('stores/store-result', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionRemoveFav() 
    {
        if ($this->request->isAjax) {
            if ($this->request->post('action') == 'remove_fav_item') {
                $userId = Yii::$app->user->id;
                $product_id = $this->request->post('id');
                $model = Favorites::findOne($id);

                if (!$model->delete()) {
                    return json_encode(['success' => false, 'message' => 'Unable to remove fav item']);
                }
                $totalfav = Favorites::find(['user_id' => $userId])->count();
                return json_encode([
                    'success' => true,
                    'totalfav' => $totalfav
                ]);
            }
        }    
        
    }

    public function actionFavorites()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $products = Product::find()->limit (12)->all();
            
        // echo'<pre>';
        // print_r($products);
        // echo'<pre>';
        // exit;
        $userId = Yii::$app->user->id;
        $product_id = $this->request->post('id');
        
        $model = new Favorite();
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            $ifExist = Favorite::findOne(['product_id'=> $product_id]);
            if(!empty($ifExist)){ // if fav product already have record in table
                Favorite::deleteAll(['product_id'=> $product_id]);
                $favoritestotal = Favorite::find()->where(['user_id' => $userId])->count();
                return json_encode(['type'=>'remove','status' => 'success', 'favoritestotal' => $favoritestotal]);
            }else{
                $model->user_id = Yii::$app->user->id;
                $model->product_id = $product_id;
                $model->customer_id = Yii::$app->user->id;
                $model->qty = 1;
                $model->created_at = date('Y-m-d H:i:s');
            
                if ($model->save()) {
                    $favoritestotal = Favorite::find()->select(['SUM(qty) qty'])->where(['user_id' => $userId])->one();
                    $favoritestotal = $favoritestotal->qty;
                    return json_encode(['type'=>'add','status' => 'success', 'favoritestotal' => $favoritestotal]);
                } else {
                    return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
                }
                return json_encode(['status' => true]);   
            }     
        }

        $favorites = Yii::$app->db->createCommand("
            SELECT product.id,product.price,product.image_url,product.status
            FROM product
            INNER JOIN favorite 
            ON product.id = favorite.product_id
            WHERE favorite.user_id = :userId
            GROUP BY id"
            )
            ->bindParam('userId', $userId)
            ->queryAll();


        return $this->render('favorites', [
          'model' => $model,
          'favorites' => $favorites,
          'products' => $products,
          
        ]); 
    }

    public function actionAddCart()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            if (Yii::$app->user->isGuest) {
                return $this->render(['site/login']);
            }
            $id = $this->request->post('id');
            $userId = Yii::$app->user->id;
            $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $userId])->one();
            if ($cart) {
                $cart->quantity++;
            } else {
                $cart = new Cart();
                $cart->user_id = $userId;
                $cart->product_id = $id;
                $cart->quantity = 1;
            }
            if ($cart->save()) {
                $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
                $totalCart = $totalCart->quantity;
                return json_encode(['status' => 'success', 'totalCart' => $totalCart]);
            } else {
                return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
            }

            return json_encode(['success' => true]);
        }
        $model = Product::find()->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['type_item' => 1]),
        ]);
        $dataProvider1 = new ActiveDataProvider([
            'query' => Product::find()->where(['type_item' => 2]),
        ]);

        return $this->render('stores/store', [
            'dataProvider' => $dataProvider,
            'dataProvider1'=> $dataProvider1,
            'model' => $model,
        ]);

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionStoreWatch()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['type_item' => 5]),
        ]);

        return $this->render('stores/store-watch', [
            'dataProvider' => $dataProvider,
        ]);

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    //////////////////////
    //////////////////////Man

    public function actionStoreMan()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            if (Yii::$app->user->isGuest) {
                return $this->redirect(['site/login']);
            }

            $id = $this->request->post('id');
            $userId = Yii::$app->user->id;
            $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $userId])->one();
            if ($cart) {
                $cart->quantity++;
            } else {
                $cart = new Cart();
                $cart->user_id = $userId;
                $cart->product_id = $id;
                $cart->quantity = 1;
            }
            if ($cart->save()) {
                $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
                $totalCart = $totalCart->quantity;
                return json_encode(['status' => 'success', 'totalCart' => $totalCart]);
            } else {
                return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
            }

            return json_encode(['success' => true]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['type_item' => 2]),
            'pagination' => array('pageSize' => 9),
        ]);

        return $this->render('stores/store-man', [
            'dataProvider' => $dataProvider,
        ]);

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /////////////////////////////////////////////////////////////Category-Top//////////////////////////////////

    public function actionStoreTopTshirtMan($sort = 'featured')
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Product::find()->where(['type_item' => 2]),
        //     'pagination' => array('pageSize' => 9),
        // ]);
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['type_item' => 2]);
        $dataProvider->pagination = ['pageSize' => 2];
        $drowdown = [
            'featured' => 'Featured',
            'date_new_to_old' => 'Date,new to old',
            'date_old_to_new' => 'Date,old to new',
            'a_to_z' => 'A to Z',
            'z_to_a' => 'Z to A',
            'price_low_to_high' => 'Price low to high',
            'price_high_to_low' => 'Price high to low',
        ];
        return $this->render('stores/man/top-man/tshirt', [
            'dataProvider' => $dataProvider,
            'drowdown' => $drowdown,
            'sort' =>  $sort,
            'searchModel' => $searchModel
        ]);
        
    }


    ////////////////////////////////////////////////////////////Category-Bottoms/////////////////////////////////
    public function actionStoreBottomsJeanMan($sort = 'featured')
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Product::find()->where(['type_item' => 3]),
        //     'pagination' => array('pageSize' => 9),
        // ]);
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['type_item' => 3]);
        $dataProvider->pagination = ['pageSize' => 2];

        $drowdown = [
            'featured' => 'Featured',
            'date_new_to_old' => 'Date,new to old',
            'date_old_to_new' => 'Date,old to new',
            'a_to_z' => 'A to Z',
            'z_to_a' => 'Z to A',
            'price_low_to_high' => 'Price low to high',
            'price_high_to_low' => 'Price high to low',
        ];
        return $this->render('stores/man/category-bottoms-man/jean', [
            'dataProvider' => $dataProvider,
            'drowdown' => $drowdown,
            'sort' =>  $sort,
            'searchModel' => $searchModel
        ]);
        
    }

    /////////////////////////////////////////////////////////////Category-Accessories///////////////////////////////

    public function actionStoreAccessoriesHatMan($sort = 'featured')
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Product::find()->where(['type_item' => 3]),
        //     'pagination' => array('pageSize' => 9),
        // ]);
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['type_item' => 3]);
        $dataProvider->pagination = ['pageSize' => 2];

        $drowdown = [
            'featured' => 'Featured',
            'date_new_to_old' => 'Date,new to old',
            'date_old_to_new' => 'Date,old to new',
            'a_to_z' => 'A to Z',
            'z_to_a' => 'Z to A',
            'price_low_to_high' => 'Price low to high',
            'price_high_to_low' => 'Price high to low',
        ];
        return $this->render('stores/man/accessories-man/hat', [
            'dataProvider' => $dataProvider,
            'drowdown' => $drowdown,
            'sort' =>  $sort,
            'searchModel' => $searchModel
        ]);
       
    }


    ///////////////////////////
    ////////////////////////////Woman

    public function actionStoreWomen()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('success', 'Profile updated successfully');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update profile');
            }

            $id = $this->request->post('id');
            $userId = Yii::$app->user->id;
            $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $userId])->one();
            if ($cart) {
                $cart->quantity++;
            } else {
                $cart = new Cart();
                $cart->user_id = $userId;
                $cart->product_id = $id;
                $cart->quantity = 1;
            }
            if ($cart->save()) {
                $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
                $totalCart = $totalCart->quantity;
                return json_encode(['status' => 'success', 'totalCart' => $totalCart]);
            } else {
                return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
            }

            return json_encode(['success' => true]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['type_item' => 1]),
            'pagination' => array('pageSize' => 9),
        ]);

        return $this->render('stores/store-women', [
            'dataProvider' => $dataProvider,
        ]);

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /////////////////////////////////////////Top-Woman///////////////////////////////
    public function actionStoreTopTshirtWoman($sort = 'featured')
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Product::find()->where(['type_item' => 2]),
        //     'pagination' => array('pageSize' => 9),
        // ]);
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['type_item' => 2]);
        $dataProvider->pagination = ['pageSize' => 2];

        $drowdown = [
            'featured' => 'Featured',
            'date_new_to_old' => 'Date,new to old',
            'date_old_to_new' => 'Date,old to new',
            'a_to_z' => 'A to Z',
            'z_to_a' => 'Z to A',
            'price_low_to_high' => 'Price low to high',
            'price_high_to_low' => 'Price high to low',
        ];
        return $this->render('stores/woman/top-woman/tshirt', [
            'dataProvider' => $dataProvider,
            'drowdown' => $drowdown,
            'sort' =>  $sort,
            'searchModel' => $searchModel
        ]);
        
    }

    /////////////////////////////////////////Bottoms-Woman//////////////////////////////

    public function actionStoreBottomsJeanWoman($sort = 'featured')
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Product::find()->where(['type_item' => 2]),
        //     'pagination' => array('pageSize' => 9),
        // ]);
        
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['type_item' => 2]);
        $dataProvider->pagination = ['pageSize' => 2];

        $drowdown = [
            'featured' => 'Featured',
            'date_new_to_old' => 'Date,new to old',
            'date_old_to_new' => 'Date,old to new',
            'a_to_z' => 'A to Z',
            'z_to_a' => 'Z to A',
            'price_low_to_high' => 'Price low to high',
            'price_high_to_low' => 'Price high to low',
        ];
        return $this->render('stores/woman/bottoms-woman/jeans', [
            'dataProvider' => $dataProvider,
            'drowdown' => $drowdown,
            'sort' =>  $sort,
            'searchModel' => $searchModel
        ]);
    }


    public function actionStoreSingle($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        $products = Product::find()->where(['id' => $id])->one();

        if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
            if ($this->request->post('action') == 'btn-add-to-cart') {
                if (Yii::$app->user->isGuest) {
                    return $this->render(['site/login']);
                }
                $colorId = $this->request->post('colorId');
                $sizeId = $this->request->post('sizeId');
                $id = $this->request->post('id');
                $userId = Yii::$app->user->id;
                $coupon = Yii::$app->db->createCommand(
                    "SELECT
                id
                FROM
                    `coupon` 
                WHERE
                CURDATE() < expire_date "
                )->queryScalar();
                $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $userId, 'color_id' => $colorId, 'size_id' => $sizeId])->one();
                if ($cart) {
                    $cart->quantity++;
                } else {
                    $cart = new Cart();
                    $cart->user_id = $userId;
                    $cart->product_id = $id;
                    $cart->quantity = 1;
                    $cart->size_id = $sizeId;
                    $cart->color_id = $colorId;
                    $cart->coupon_id = $coupon;
                }
                if ($cart->save()) {
                    $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
                    $totalCart = $totalCart->quantity;
                    return json_encode(['status' => 'success', 'totalCart' => $totalCart]);
                } else {
                    return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
                }

                return json_encode(['success' => true]);
            } else if ($this->request->post('action') == 'btn-buy-now') {
                if (Yii::$app->user->isGuest) {
                    return $this->render(['site/login']);
                }
                $colorId = $this->request->post('colorId');
                $sizeId = $this->request->post('sizeId');
                $id = $this->request->post('id');
                $userId = Yii::$app->user->id;
                $cart = Cart::find()->where(['product_id' => $id, 'user_id' => $userId, 'color_id' => $colorId, 'size_id' => $sizeId])->one();
                if ($cart) {
                    $cart->quantity++;
                } else {
                    $cart = new Cart();
                    $cart->user_id = $userId;
                    $cart->product_id = $id;
                    $cart->quantity = 1;
                    $cart->size_id = $sizeId;
                    $cart->color_id = $colorId;
                }
                if ($cart->save()) {
                    $totalCart = Cart::find()->select(['SUM(quantity) quantity'])->where(['user_id' => $userId])->one();
                    $totalCart = $totalCart->quantity;
                    return $this->redirect(['site/checkout']);
                } else {
                    return json_encode(['status' => 'error', 'message' => "something went wrong."]);;
                }

                return json_encode(['success' => true]);
            }
        }
        $relatedProduct = Product::find()->all();
        return $this->render('stores/store-single', [
            'dataProvider' => $dataProvider,
            'relatedProduct' => $relatedProduct,
            'products' => $products
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    //action Signup
    public function actionSign()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
            return $this->redirect(['site/login']);
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionCheckout()
    {
        // $this->layout = 'header-sec';
        $model = new OrderItem();
        $current_user = Yii::$app->user->id;
        $totalCart = Cart::find()->select(['user_id'])->where(['user_id' => $current_user])->count();
        if ($totalCart) {
            $userId = Yii::$app->user->id;
            $coupon = Yii::$app->db->createCommand(
                "SELECT
                            id
                        FROM
                            `coupon` 
                        WHERE
                        CURDATE() < expire_date "
            )->queryScalar();
            if ($coupon) {
                $totalPrice = Yii::$app->db->createCommand("SELECT 
               SUM( cart.quantity * (product.price - (product.price * (coupon.discount / 100)))) as total_price
                FROM cart
                INNER JOIN product ON product.id = cart.product_id
                INNER JOIN coupon ON coupon.id = cart.coupon_id 
                WHERE cart.coupon_id = :coupon AND coupon.expire_date > CURDATE()
            ")
                ->bindParam('coupon', $coupon)
                ->queryScalar();
            } else {
                $totalPrice = Yii::$app->db->createCommand("SELECT 
               SUM( cart.quantity * (product.price)) as total_price
                FROM cart
                INNER JOIN product ON product.id = cart.product_id
                WHERE cart.user_id = :userId
            ")
                ->bindParam('userId', $userId)
                ->queryScalar();
            }
            $userId = Yii::$app->user->id;
            $relatedProduct = Yii::$app->db->createCommand(
                "SELECT product.*,cart.color_id, cart.size_id, cart.quantity, cart.id AS cart_id, variant_size.size, variant_color.color  FROM cart
            INNER JOIN product ON product.id = cart.product_id
            INNER JOIN variant_size ON variant_size.id = cart.size_id
            INNER JOIN variant_color ON variant_color.id = cart.color_id
            WHERE cart.user_id = :userId"
            )
                ->bindParam('userId', $userId)
                ->queryAll();
            $totalCart = Cart::find()->select(['user_id'])->where(['user_id' => $current_user])->count();
            return $this->render(
                'checkout',
                [
                    'model' => $model,
                    'totalPrice' => $totalPrice,
                    'totalCart' => $totalCart,
                    'relatedProduct' => $relatedProduct
                ]
            );
        } else {
            Yii::$app->session->setFlash('error', 'Please Add some product!');
            return $this->redirect('cart');
        }
    }
    public function actionPayment()
    {
        if ($this->request->isAjax && $this->request->isPost) {
            $userId = Yii::$app->user->id;
            $profile = Yii::$app->user->identity->username;
            $payer_id = $this->request->post('payer_id');
            $carts = Cart::find()->where(['user_id' => $userId])->all();
            $customer = Customer::find()->where(['name' => $profile])->one();
            $product = Yii::$app->db->createCommand("SELECT
                SUM( product.price * cart.quantity ) AS sub_total 
            FROM
                cart
                INNER JOIN product ON product.id = cart.product_id 
            WHERE
                cart.user_id = :userId
            ")
                ->bindParam('userId', $userId)
                ->queryOne();

            if (!$customer) {
                $customer = new Customer();
                $customer->name = $profile;
                $customer->address = Yii::$app->user->identity->email;
                $customer->save();
            }
            $order = new Order();
            $order->code = $payer_id;
            $order->customer_id = $customer->id;
            $order->sub_total = $product['sub_total'];
            $order->grand_total = $product['sub_total'] - $order->discount;
            $order->created_date = date('Y-m-d H:i:s');
            $order->created_by = Yii::$app->user->identity->id;
            if ($order->save()) {
                $order_item_values = [];
                foreach ($carts as $cart) {
                    array_push($order_item_values, [$order->id, $cart->product_id, $cart->color_id, $cart->size_id, $cart->quantity, $cart->product->price, $cart->product->price * $cart->quantity, date('Y-m-d H:i:s')]);
                }
                $query = Yii::$app->db->createCommand()->batchInsert(
                    'order_item',
                    ['order_id', 'product_id', 'color', 'size', 'qty', 'price', 'total', 'created_date'],
                    $order_item_values
                );
                if ($query->execute()) {
                    $invoices = new Invoices();
                    $invoices->Customer = $customer->id;
                    $invoices->Type = "Invoices";
                    $invoices->status = "Paid";
                    if ($invoices->save()) {
                        Cart::deleteAll(['id' => ArrayHelper::getColumn($carts, 'id')]);
                        Yii::$app->session->setFlash('success', 'Profile updated successfully');
                        return $this->redirect(['site/add-cart']);
                    }
                }
            }
        }
    }

    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $model = User::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post())) {
            
            if(!empty(UploadedFile::getInstance($model, 'image_url')))
            {
                $imagename = Inflector::slug($model->status) . '-' . time();
                $model->image_url = UploadedFile::getInstance($model, 'image_url');

                // upload ptofile
                $upload_path = ("profile/uploads/");
                if (!is_dir($upload_path)) mkdir($upload_path, 0777, true); 

                $model->image_url->saveAs($upload_path . $imagename . '.' . $model->image_url->extension);
                $model->image_url = $imagename . '.' . $model->image_url->extension;
            }
            // echo"<pre>";
            // print_r($model->getAttributes());
            // exit;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Profile updated successfully');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update profile');
            }
        }
        return $this->render(
            'profile',
            [
                'model' => $model,
            ]
        );
    }
    
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}