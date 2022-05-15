<?php

namespace backend\controllers;

use backend\models\Orders;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

class ScheduleController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = (!empty($_GET['pageSize']) ? $_GET['pageSize'] : 10);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        $orders = Orders::find()->all();

        $tasks = [];

        foreach($orders as $order){ 
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $order->id;
            $event->title = $order->order_id;
            $event->start = date('Y-m-d\TH:i:s\Z',strtotime($order->delivery_date));
            if($order->order_status == 0){
                $event->backgroundColor = 'blue';
            }
            else if($order->order_status == 1){
                $event->backgroundColor = 'green';
            }
            else if($order->order_status == 2){
                $event->backgroundColor = 'red';
            }
            $tasks[] = $event;
        }

        return $this->render('view',[
            'tasks'=> $tasks
        ]);
    }

    public function actionViewOrder($id)
    {
        return $this->render('view_order', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
