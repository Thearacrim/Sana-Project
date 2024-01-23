<?php

namespace app\modules\Admin\controllers;

use app\modules\Admin\models\Banner;
use yii;
use app\modules\Admin\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
     * Lists all Banner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Banner();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $imagename = Inflector::slug($model->title) . '-' . time();
                $model->image = UploadedFile::getInstance($model, 'image');
                // print_r($model->image);
                // exit;
                $upload_path = Yii::getAlias("banner/");
                if (!empty($model->image)) {
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }   
                    $filename = 'banner/' . $imagename . '.' . $model->image->extension;
                    $model->image->saveAs($upload_path . $imagename . '.' . $model->image->extension);
                    //save file uploaded to db
                    $model->image_banner = $filename;
                }
                // echo $model->image_banner;
                // exit;
                if ($model->save()) {
                    // exit;
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
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $imagename = Inflector::slug($model->title) . '-' . time();
                $model->image = UploadedFile::getInstance($model, 'image');
                $upload_path = Yii::getAlias("banner/");
                if (!empty($model->image)) {
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }
                    $model->image->saveAs($upload_path . $imagename . '.' . $model->image->extension);
                    //save file uploaded to db
                    $model->image_banner = 'banner/' . $imagename . '.' . $model->image->extension;
                }
                if ($model->save()) {
                    // exit;
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    print_r($model->getErrors());
                    exit;
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Banner model.
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
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}