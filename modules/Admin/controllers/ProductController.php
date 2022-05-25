<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\Product;
use app\modules\Admin\models\ProductSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\web\UploadedFile;
use yii2tech\csvgrid\CsvGrid;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // Set pagination with searchModel
        $dataProvider->setPagination(['pageSize' => 5]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExport()
    {

        $exporter = new CsvGrid([
            'dataProvider' => new ActiveDataProvider([
                'query' => Product::find(),
            ]),
            'columns' => [
                [
                    'attribute' => 'id',
                    'label' => 'ID'
                ],
                [
                    'attribute' => 'status',
                    'label' => 'Product Name',
                ],
                [
                    'attribute' => 'price',
                    'label' => 'Price'
                ],
            ],
        ]);
        return $exporter->export()->send('products.csv');
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $imagename = Inflector::slug($model->status) . '-' . time();
                $model->image_url = UploadedFile::getInstance($model, 'image_url');
                $upload_path = Yii::getAlias("uploads/");
                if (!empty($model->image_url)) {
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }
                    $model->image_url->saveAs($upload_path . $imagename . '.' . $model->image_url->extension);
                    //save file uploaded to db
                    $model->image_url = 'uploads/' . $imagename . '.' . $model->image_url->extension;
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    print_r($model->getErrors());
                    exit;
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $imagename = Inflector::slug($model->status) . '-' . time();
            $model->image_url = UploadedFile::getInstance($model, 'image_url');
            $upload_path = Yii::getAlias("uploads/");
            if (!empty($model->image_url)) {
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                $model->image_url->saveAs($upload_path . $imagename . '.' . $model->image_url->extension);
                // echo $model->image_url;
                // exit;sdfa
                //save file uploaded to db
                $model->image_url = 'uploads/' . $imagename . '.' . $model->image_url->extension;
                // print_r($model->image_url);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Updated successfully');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
                exit;
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
