<?php

namespace backend\controllers;

use backend\models\Orders;
use backend\models\Products;
use backend\models\OrderItems;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use Yii;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['view', 'update', '_form', 'index', 'delete', 'print-invoice'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider2 = $searchModel->searchAll($this->request->queryParams);
        $dataProvider->pagination->pageSize = (!empty($_GET['pageSize']) ? $_GET['pageSize'] : 10);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $order = Orderitems::find()->where(['order_id' => $id])->asArray()->all();

        foreach ($order as $key => $items) {
            $product[] = Products::find()->where(['product_id' => $items['product_id']])->asArray()->all();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'product' => $product,
            'order' => $order
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Order is updated successfully.");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        OrderItems::deleteAll(['order_id' => $id]);

        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', "Order is deleted successfully.");

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrintInvoice($id)
    {
        $orders = OrderItems::find()->where(['order_id' => $id])->asArray()->all();
        foreach ($orders as $key => $item) {
            $products[] = Products::find()->where(['product_id' => $item['product_id']])->asArray()->all();
        }

        $content = $this->renderPartial('invoice', [
            'model' => $this->findModel($id),
            'products' => $products,
            'orders' => $orders
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'methods' => [
                'SetHeader' => ['PERABOT SG BESAR'],
                'SetFooter' => [
                    ' 
                    Perabot Sg Besar <br>
                    No 10-18, Jalan Sbbc 6, <br>
                    45300 Sungai Besar <br>
                    Selangor, Malaysia.'
                ],
                'SetTitle' => 'Invoice',
            ]
        ]);

        return $pdf->render();
    }
}
