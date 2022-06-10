<?php

namespace backend\controllers;

use backend\models\Orders;
use backend\models\OrderSearch;
use backend\models\Customers;
use backend\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

class ScheduleController extends Controller
{

    public $enableCsrfValidation = false;

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

            if($model->staff_id != null){
                $staff = User::find()->where(['id' => $model->staff_id])->one();
                $customer = Customers::find()->where(['customer_id' => $model->customer_id])->one();

                $content = 'Hello '. $staff->username . ', Order ID: '. $model->order_id. ' need to be delivered on '. $model->delivery_date;
                Yii::$app->mailer->compose()
                ->setFrom(['yimincheah13@gmail.com' => 'Perabot Sg Besar'])
                ->setTo($staff->email)
                ->setSubject('Order Delivery')
                ->setTextBody($content)
                ->send();

                $content2 = 'Hello '. $customer->customer_name . ', your order ID: '. $model->order_id. ' will be delivered on '. $model->delivery_date;
                Yii::$app->mailer->compose()
                ->setFrom(['yimincheah13@gmail.com' => 'Perabot Sg Besar'])
                ->setTo($customer->customer_email)
                ->setSubject('Order Delivery')
                ->setTextBody($content2)
                ->send();
        
                Yii::$app->session->setFlash('success','Email Send Successfully');
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSendNotification($staff_id, $id){
        
        $model = User::find()->where(['id' => $staff_id])->one();
        $order = Orders::find()->where(['id' => $id])->one();
        $staff_name = $model->username;

        $content = 'Hello '. $staff_name . ', Order ID: '. $order->order_id. ' need to be delivered on '. $order->delivery_date;
        Yii::$app->mailer->compose()
        ->setFrom(['yimincheah13@gmail.com' => 'Perabot Sg Besar'])
        ->setTo($model->email)
        ->setSubject('Order Delivery')
        ->setTextBody($content)
        ->send();

        Yii::$app->session->setFlash('success','Email Send Successfully');

        return $this->redirect(['schedule/index']);

    }
}
