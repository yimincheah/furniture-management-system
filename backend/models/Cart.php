<?php

namespace backend\models;

use Yii;

class Cart extends \yii\db\ActiveRecord
{
    public function addToCart($product, $qty){
       
        if(isset($_SESSION['cart'][$product->product_id])){
            $_SESSION['cart'][$product->product_id]['qty'] += $qty;
        }
        else{
            $_SESSION['cart'][$product->product_id] = [
                'qty'=>$qty,
                'product_name'=>$product->product_name,
                'product_price'=>$product->product_price,
                'product_category'=>$product->category_id,
                'product_brand'=>$product->brand_id,
                'ref'=>$product->ref,
            ];
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;

        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->product_price: $qty * $product->product_price;
       
    }

    public function reduceCart($id)
    {
        if(!isset($_SESSION['cart'][$id])) return false;

        $qtyMinus = --$_SESSION['cart'][$id]['qty'] ;
        $_SESSION['cart.qty'] = $qtyMinus;
        $_SESSION['cart.sum'] = $_SESSION['cart.sum']- $_SESSION['cart'][$id]['product_price'];
        

        if($qtyMinus == 0)
        {
            unset($_SESSION['cart'][$id]);   
        }
       
    }

    public function increaseCart($id)
    {
        if(!isset($_SESSION['cart'][$id])) return false;

        $qtyPlus = ++$_SESSION['cart'][$id]['qty'] ;

        $_SESSION['cart.qty'] = $qtyPlus;
        $_SESSION['cart.sum'] = $_SESSION['cart.sum'] + $_SESSION['cart'][$id]['product_price'];
       
    }
}

