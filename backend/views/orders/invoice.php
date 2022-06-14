<?php

use backend\models\UploadsProduct;
use backend\models\Categorys;
use backend\models\Brands;

\yii\web\YiiAsset::register($this);
?>

<div id="cart" class="cart_section">
    <div class="container-fluid">

        <div>
            <b>Billing Address</b><br>
            <?= $model->customer->customer_name ?><br>
            <?= $model->address_line1 ?><br>
            <?php if ($model->address_line2 == null) {
            } else { ?>
                <?= $model->address_line2 ?><br>
            <?php } ?>
            <?= $model->city ?>,<?= $model->state ?>,<br>
            <?= $model->country ?>.<br>
        </div>

        <hr>

        <b>Order ID : </b> <?= $model->order_id ?> <br>
        <b>Delivery Date : </b> <?= $model->delivery_date ?> <br>
        <b>Ordered Date : </b>
        <?= $model->created_at ?>

        <br><br>

        <div class="container-fluid">
            <div class="row">
                <div class="table-custom-responsive wow fadeInDown animated">
                    <table class="table-custom table-cart table-responsive">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $key => $product) { ?>
                                <?php

                                $uploads = UploadsProduct::find()->where(['ref' => $product[0]['ref']])->asArray()->all();
                                $category = Categorys::find()->where(['category_id' => $product[0]['category_id']])->asArray()->one();
                                $brand = Brands::find()->where(['brand_id' => $product[0]['brand_id']])->asArray()->one();

                                ?>
                                <tr>
                                    <td>
                                        <img src="<?= Yii::getAlias('@web') . '/products/' . $uploads[0]['ref'] . '/' . $uploads[0]['real_filename'] ?>" alt="img" width="146" height="132">
                                    </td>
                                    <td><?= $product[0]['product_name'] ?>&nbsp;&nbsp;&nbsp;</td>
                                    <td><?= $category['category_name'] ?>&nbsp;&nbsp;&nbsp;</td>
                                    <td><?= $brand['brand_name'] ?>&nbsp;&nbsp;&nbsp;</td>
                                    <td>RM <?= $orders[$key]['price'] ?>&nbsp;&nbsp;&nbsp;</td>
                                    <td><?= $orders[$key]['quantity'] ?>&nbsp;&nbsp;&nbsp;</td>
                                    <td>RM <?= $orders[$key]['total_price'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <p style="text-align: right">
                    Total Quantity : <?= $model->order_quantity ?> units <br>
                    Total Price : RM <?= $model->total_price ?>
                </p>

            </div>
        </div>
    </div>
</div>