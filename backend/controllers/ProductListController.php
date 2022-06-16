<?php

namespace backend\controllers;

use yii\web\Controller;
use backend\models\Products;
use backend\models\Categorys;
use backend\models\Brands;
use backend\models\UploadsProduct;
use yii\data\Pagination;
use yii\filters\AccessControl;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductListController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index','category-list','brand-list','search','single-product'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
            ]
        );
    }

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $categories = Categorys::find()->where(['category_status' => 'active'])->all();
        $brands = Brands::find()->where(['brand_status' => 'active'])->all();
        $query = Products::find()->where(['product_status' => 1]);
        $pagination = new Pagination(
            [
                'defaultPageSize' => 6,
                'totalCount' => $query->count(),
            ]
        );

        $products = $query->orderBy('product_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();



        return $this->render('index', [
            'pagination' => $pagination,
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function actionCategoryList($id)
    {
        $categories = Categorys::find()->where(['category_status' => 'active'])->all();
        $brands = Brands::find()->where(['brand_status' => 'active'])->all();
        $query = Products::find()->where(['category_id' => $id, 'product_status' => 1]);
        $pagination = new Pagination(
            [
                'defaultPageSize' => 6,
                'totalCount' => $query->count(),
            ]
        );

        $products = $query->orderBy('product_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();



        return $this->render('category_list', [
            'pagination' => $pagination,
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function actionBrandList($id)
    {
        $categories = Categorys::find()->where(['category_status' => 'active'])->all();
        $brands = Brands::find()->where(['brand_status' => 'active'])->all();
        $query = Products::find()->where(['brand_id' => $id, 'product_status' => 1]);

        $pagination = new Pagination(
            [
                'defaultPageSize' => 6,
                'totalCount' => $query->count(),
            ]
        );

        $products = $query->orderBy('product_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();



        return $this->render('brand_list', [
            'pagination' => $pagination,
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function actionSearch()
    {
        $categories = Categorys::find()->where(['category_status' => 'active'])->all();
        $brands = Brands::find()->where(['brand_status' => 'active'])->all();
        $query = Products::find();

        $query->andFilterWhere([
            'product_status' => 1,
        ]);

        if (!empty($_POST['searchName'])) {
            $query->andFilterWhere(['like', 'product_name', ['product_name' => $_POST['searchName']]]);
        }

        $pagination = new Pagination(
            [
                'defaultPageSize' => 6,
                'totalCount' => $query->count(),
            ]
        );

        $products = $query->orderBy('product_id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('search_list', [
            'pagination' => $pagination,
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function actionSingleProduct($id)
    {

        $product = Products::find()->where(['product_id' => $id])->one();
        $brand = Brands::find()->where(['brand_id' => $product->brand_id])->one();
        $category = Categorys::find()->where(['category_id' => $product->category_id])->one();
        $uploads = UploadsProduct::find()->where(['ref' => $product->ref])->asArray()->all();

        return $this->render('single_product', [
            'product' => $product,
            'brand' => $brand,
            'category' => $category,
            'uploads' => $uploads,
        ]);
    }
}
