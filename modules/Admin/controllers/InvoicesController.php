<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\Customer;
use app\modules\Admin\models\Invoices;
use app\modules\Admin\models\Order;
use app\modules\Admin\models\OrderItem;
use app\modules\Admin\models\Product;
use app\modules\Admin\models\SearchInvoices;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * InvoicesController implements the CRUD actions for Invoices model.
 */
class InvoicesController extends Controller
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

    // / Privacy statement output demo
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

    /**
     * Lists all Invoices models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchInvoices();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 5]);
        $invoice = Invoices::find()->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'invoice' => $invoice
        ]);
    }

    /**
     * Displays a single Invoices model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderItem::find()->where(['order_id' => $id]),
        ]);
        $user = Yii::$app->user->identity->id;
        $order_item = Yii::$app->db->createCommand("SELECT SUM(total) as total_price FROM `order_item` 
            where order_id = :id")
            ->bindParam("id", $id)
            ->queryOne();
        $order = Order::find()->one();
        $customer = Yii::$app->db->createCommand("SELECT
            customer.name,
            customer.address
            FROM invoices
            INNER JOIN customer ON customer.id = invoices.Customer
            WHERE invoices.id = :id")
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
     * Creates a new Invoices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Invoices();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing Invoices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Updated successfully');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update profile');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Invoices model.
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
     * Finds the Invoices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Invoices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoices::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
