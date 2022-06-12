<?php

namespace backend\controllers;

use Yii;
use backend\models\AuthAssignment;
use backend\models\StaffSearch;
use backend\models\Orders;
use backend\models\OrderSearch;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * StaffController implements the CRUD actions for AuthAssignment model.
 */
class StaffController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
                        'actions' => ['view','update','_form','index','schedule','delete', 'view-order'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['schedule','view-order','view-schedule','update'],
                        'allow' => true,
                        'roles' => ['staff'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param integer $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param integer $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_name, $user_id)
    {

        $this->findModel($item_name, $user_id)->delete();

        $model = User::findOne(['id'=>$user_id]);
        $model->delete();
        Yii::$app->session->setFlash('success', "Staff is deleted successfully."); 

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param integer $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSchedule()
    {
        $orders = Orders::find()->where(['staff_id'=>Yii::$app->user->id])->all();

        $events = [];

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
            $events[] = $event;
        }

        return $this->render('schedule',[
            'events'=> $events
        ]);
    }

    public function actionViewOrder($id)
    {
        return $this->render('view_order', [
            'model' => $this->findOrder($id),
        ]);
    }

    protected function findOrder($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionViewSchedule()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->searchStaffSchedule(Yii::$app->request->queryParams);

        return $this->render('view_schedule', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findOrder($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-schedule']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}
