<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Products;
use backend\models\Customers;
use backend\models\States;
use backend\models\Cart;
use backend\models\City;
use backend\models\Orders;
use backend\models\OrderItems;
use yii\helpers\Json;
use Yii;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class CartController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAddToCart()
    {
        $id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $product = Products::findOne($id);
        if(empty($product)) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product,$qty);
       
        return $this->redirect(['cart/index']);
    }

    public function actionIndex()
    {
        $session = Yii::$app->session;
        $session->open();
        $carts = $session['cart'];
        $sum = $session['cart.sum'];

        return $this->render('index', [
           'carts'=>$carts,
           'sum'=>$sum,
        ]);
    }

    public function actionClearCart()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        return $this->render('index',[
           'carts'=> $session['cart'],
           'sum'=> $sum = $session['cart.sum']
        ]);

    }

    public function actionReduceCartQuantity()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->reduceCart($id);
        
        $result = $session['cart'];
        $sum = $session['cart.sum'];

        return $this->render('index',[
            'carts'=>$result,
            'sum'=>$sum,
        ]);   
    }

    public function actionAddCartQuantity()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->increaseCart($id);
        
        $result = $session['cart'];
        $sum = $session['cart.sum'];

        return $this->render('index',[
            'carts'=>$result,
            'sum'=>$sum,
        ]);    
    }

    public function actionProceedToCheckout()
    {
        $session = Yii::$app->session;
        $session->open();
        $carts = $session['cart'];
        $sum = $session['cart.sum'];

        $model = new Orders();

        if($model->load(Yii::$app->request->post()))
        {
            $model->order_id = Yii::$app->security->generateRandomString(12);
            $model->order_quantity = $session['cart.qty'];
            $model->total_price = $sum;
            $model->order_status = 1;
   
            if($model->save())
            {
               $this->saveOrderItems($session['cart'], $model->id);
               $session->remove('cart');
               $session->remove('cart.qty');
               $session->remove('cart.sum');

               Yii::$app->session->setFlash('success','Order Added Successfully');

               return $this->redirect(['cart/index']);
            }
           
        }

        return $this->render('list',[
            'carts'=>$carts,
            'sum'=>$sum,
            'model'=>$model,
        ]);
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach($items as $id => $item)
        {
            $model = new OrderItems();
            $model->order_id = $order_id;
            $model->product_id = $id;
            $model->price = $item['product_price'];
            $model->quantity = $item['qty'];
            $model->total_price = $item['qty']*$item['product_price'];
            $model->save();
            //print_r($model->getErrors());die();

        }
    }

    public function actionGetAddress($id)
    {
       $customer = Customers::findOne($id);
       echo Json::encode($customer);
    }
    
    public function actionGetState($id)
    {
       $state = States::findOne($id);
       echo Json::encode($state);
    }

    public function actionGetCity($id)
    {
       $city = City::findOne($id);
       echo Json::encode($city);
    }

}