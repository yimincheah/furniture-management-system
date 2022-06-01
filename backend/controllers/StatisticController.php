<?php

namespace backend\controllers;

use backend\models\Orders;
use backend\models\Customers;
use backend\models\Categorys;
use backend\models\Brands;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class StatisticController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model =new Orders();
        $customer = Customers::find()->count();
        $totalEarning = Orders::find()->sum('total_price');
        $order= Orders::find()->count();
        $product= Orders::find()->sum('order_quantity');

        $totalEarningByYear = Orders::findBySql(
            "
            SELECT 
            DATE_FORMAT(date(o.created_at),'%Y') as `year`,
            SUM(o.total_price) as `sum`
            FROM orders o
            GROUP BY DATE_FORMAT(date(o.created_at),'%Y')
            "
        )->asArray()->all();

        $total_year = Orders::findBySql(
            "
            SELECT YEAR(created_at) as `total_year` FROM orders as o
            GROUP BY DATE_FORMAT(date(o.created_at),'%Y')
            "
        )->asArray()->all();

        $totalEarningByMonth = Orders::findBySql(
            "
            SELECT MONTH(created_at) as `month`, total_price FROM orders as o
            WHERE YEAR(o.created_at) = 2022
            GROUP BY DATE_FORMAT(date(o.created_at),'%M')
            "
        )->asArray()->all();
        
        foreach($totalEarningByMonth as $data){
            $month[]= $data['month'];
            $monthSum[]= $data['total_price'];
        }
        //print_r($totalEarningByYear); die();

        $categories = Categorys::findBySql(
            "
            SELECT c.category_name, SUM(o.quantity) AS `category_qty` FROM categorys as c
            LEFT JOIN products as p
            ON c.category_id = p.category_id
            LEFT JOIN order_items as o 
            ON o.product_id = p.product_id
            GROUP BY c.category_name
            "
        )->asArray()->all();

        $brands = Brands::findBySql(
            "
            SELECT c.brand_name, SUM(o.quantity) AS `brand_qty` FROM brands as c
            LEFT JOIN products as p
            ON c.brand_id = p.brand_id
            LEFT JOIN order_items as o 
            ON o.product_id = p.product_id
            GROUP BY c.brand_name
            "
        )->asArray()->all();


        foreach($totalEarningByYear as $data){
            $year[]= $data['year'];
            $yearSum[]= $data['sum'];
        }

        foreach($categories as $data){
            if($data['category_qty'] == null){
                $data['category_qty'] = 0;
            }
            $category_label[]= $data['category_name'];
            $category_qty[]= $data['category_qty'];
            $category_data[] = [
                'name' => $data['category_name'],
                'data' => [(int)$data['category_qty']]
            ];
        }

        foreach($brands as $data){
            if($data['brand_qty'] == null){
                $data['brand_qty'] = 0;
            }
            $brand_data[] = [
                'name' => $data['brand_name'],
                'data' => [(int)$data['brand_qty']]
            ];
        }

        return $this->render('index', [
            'customer' => $customer,
            'order' => $order,
            'product' => $product,
            'year'=>$year,
            'yearSum'=> $yearSum,
            'category_qty' => $category_qty,
            'category_label' => $category_label,
            'categories' => $categories,
            'category_data' => $category_data,
            'brand_data' => $brand_data,
            'totalEarning' => $totalEarning,
            'totalEarningByYear' => $totalEarningByYear,
            'totalEarningByMonth' => $totalEarningByMonth,
            'total_year' => $total_year,
            'month' => $month,
            'monthSum' => $monthSum,
            'model' => $model
        ]);

    }

    public function getYear($year)
    {
        $totalEarningByMonth = Orders::findBySql(
            "
            SELECT MONTH(created_at) as `month`, total_price FROM orders as o
            WHERE YEAR(o.created_at) = $year
            GROUP BY DATE_FORMAT(date(o.created_at),'%M')
            "
        )->asArray()->all();

        return $totalEarningByMonth;

    }

}
