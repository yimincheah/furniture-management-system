<?php

namespace backend\controllers;

use backend\models\Orders;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

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
        $orders = Orders::find()->all();

        $tasks = [];

        foreach($orders as $order){ 
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $order->id;
            $event->title = $order->order_id;
            $event->start = date('Y-m-d\TH:i:s\Z',strtotime($order->delivery_date));
            $tasks[] = $event;
        }

        return $this->render('index',[
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
}
