<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\Invoices;
use app\modules\Admin\models\Order;
use app\modules\Admin\models\OrderItem;
use app\modules\Admin\models\OrderSearch;
use kartik\mpdf\Pdf;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionCreatePdf($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderItem::find()->where(['order_id' => $id]),
        ]);
        $order_item = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM `order_item` 
            where order_id = :id")
            ->bindParam("id", $id)
            ->queryOne();
        $order = Order::find()->one();
        $customer = Yii::$app->db->createCommand("SELECT customer.name as name, customer.address as address FROM `order` 
            INNER JOIN customer on customer.id = order.customer_id
            where customer.id = order.customer_id")
            ->queryOne();
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            'destination' => Pdf::DEST_BROWSER,
            'content' => $this->renderPartial('view', [
                'model' => $this->findModel($id),
                'dataProvider' => $dataProvider,
                'order_item' => $order_item,
                'order' => $order,
                'customer' => $customer
            ]),
            'options' => [
                // any mpdf options you wish to set
            ],
            'methods' => [
                'SetTitle' => 'Zay Online Invoices',
                'SetHeader' => ['Zay Online Invoices||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
                'SetAuthor' => 'Kartik Visweswaran',
                'SetCreator' => 'Kartik Visweswaran',
                'SetKeywords' => 'Zay, Yii2, Export, PDF, MPDF, Output, Privacy, Policy, yii2-mpdf',
            ]
        ]);
        return $pdf->render();
    }

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 5]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderItem::find()->where(['order_id' => $id]),
        ]);
        $order_item = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM `order_item` 
            where order_id = :id")
            ->bindParam("id", $id)
            ->queryOne();
        $order = Order::find()->one();
        $customer = Yii::$app->db->createCommand("SELECT 
         customer.name,
         customer.address 
         FROM `zay-store`.invoices
            INNER JOIN customer on invoices.Customer = customer.id  
            where invoices.id = :id")
            ->bindParam("id", $id)
            ->queryOne();
        $invoice = Invoices::find()->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'order_item' => $order_item,
            'order' => $order,
            'invoice' => $invoice,
            'customer' => $customer
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
