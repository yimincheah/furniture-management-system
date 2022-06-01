
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\chartjs\ChartJs;
use yii\helpers\ArrayHelper;

$this->title = 'Statistic';
?>

<style>
.stati{
    background: #fff;
    height: 6em;
    padding:1em;
    margin:1em 0; 
    -webkit-transition: margin 0.5s ease,box-shadow 0.5s ease; /* Safari */
    transition: margin 0.5s ease,box-shadow 0.5s ease; 
    -moz-box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
    -webkit-box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
    box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
}
.stati:hover{ 
    margin-top:0.5em;  
    -moz-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
    -webkit-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
    box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8); 
}
.stati i{
    font-size:3.5em; 
} 
.stati div{
    width: calc(100% - 3.5em);
    display: block;
    float:right;
    text-align:right;
}
.stati div b {
font-size:2.2em;
    width: 100%;
    padding-top:0px;
    margin-top:-0.2em;
    margin-bottom:-0.2em;
    display: block;
}
.stati div span {
    font-size:1em;
    width: 100%;
    color: rgb(0, 0, 0,0.8); 
    display: block;
}

.stati.left div{ 
    float:left;
    text-align:left;
}

.stati.midnight_blue { color: rgb(44, 62, 80); } 

.card {
    position: relative;
    border-radius: 0.35rem;
}
.col-xl-8 {
    flex: 0 0 66.66667%;
    max-width:100%;
}

.mb-4,
.my-4 {
    margin-bottom: 1.5rem !important;
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

</style>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                    <h2>Statistic</h2>
                    <ul>
                        <li><?= Html::a('Home', ['/']) ?></li>
                        <li><?= Html::a('Statistic', ['/statistic/index']) ?></li>
                    </ul>
            </div>
        </div>
    </div>
</section>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="stati midnight_blue left">
            <i class="glyphicon glyphicon-user"></i>
            <div>
                <p>Total Customers</p>
                <b><?= $customer ?></b>
            </div> 
        </div>
    </div> 
    <div class="col-md-3">
        <div class="stati midnight_blue left">
            <i class="glyphicon glyphicon-list-alt"></i>
            <div>
                <p>Orders Made</p>
                <b><?= $order ?></b>
            </div> 
        </div>
    </div> 
    <div class="col-md-3">
        <div class="stati midnight_blue left">
            <i class="glyphicon glyphicon-th-list"></i>
            <div>
                <p>Products Sold</p>
                <b><?= $product ?></b>
            </div> 
        </div>
    </div> 
    <div class="col-md-3">
        <div class="stati midnight_blue left">
            <i class="glyphicon glyphicon-equalizer"></i>
            <div>
                <p>Total Sales</p>
                <b>RM <?= $totalEarning ?></b>
            </div> 
        </div>
    </div> 
</div>

<br>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Total Earnings</h6>
            </div>
            <!-- Card Body -->
            <?= ChartJs::widget([
                'type' => 'line',
                'options' => [
                    'height' => 10,
                    'width' => 50
                ],
                'data' => [
                    'labels' => $year,
                    'datasets' => [
                        [
                            'label' => "Total Earnings",
                            'lineTension' => 0.3,
                            'backgroundColor' => "rgba(78, 115, 223, 0.05)",
                            'borderColor' => "rgba(78, 115, 223, 1)",
                            'pointRadius' => 3,
                            'pointBackgroundColor' =>  "rgba(78, 115, 223, 1)",
                            'pointBorderColor' =>  "rgba(78, 115, 223, 1)",
                            'pointHoverBackgroundColor' => "rgba(78, 115, 223, 1)",
                            'pointHoverBorderColor' =>"rgba(78, 115, 223, 1)",
                            'pointHitRadius' => 10,
                            'pointBorderWidth' => 5,
                            'data' => $yearSum
                        ],
                        
                    ]
                ]
            ]);
            ?>
            <!-- end card bdy -->
        </div>
    </div>

</div>
<br>
<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Overall Sales of Category</h6>
            </div>

            <!-- Card Body -->
            <?= \dosamigos\highcharts\HighCharts::widget([
                'options' => [
                    'height' => 400,
                    'width' => 500,
                ],
                'clientOptions' => [
                    'chart' => [
                            'type' => 'column'
                    ],
                    'title' => [
                        'text' => 'Categories Overall Sales'
                    ],
                    'xAxis' => [
                        'categories' => [
                            'Type of Category'
                        ]
                
                    ],
                    'yAxis' => [
                        'title' => [
                            'text' => 'Total Sales (qty) '
                        ]
                    ],
                    'series' => $category_data
                ]
            ]);
            ?>

            <!-- end card bdy -->
        </div>
    </div>
    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Overall Sales of Brand</h6>
            </div>

            <!-- Card Body -->
            <?= \dosamigos\highcharts\HighCharts::widget([
                'options' => [
                    'height' => 400,
                    'width' => 500,
                ],
                'clientOptions' => [
                    'chart' => [
                            'type' => 'column'
                    ],
                    'title' => [
                        'text' => 'Brand Overall Sales'
                    ],
                    'xAxis' => [
                        'categories' => [
                            'Type of Brand'
                        ]
                
                    ],
                    'yAxis' => [
                        'title' => [
                            'text' => 'Total Sales (qty) '
                        ]
                    ],
                    'series' => $brand_data
                ]
            ]);
            ?>

            <!-- end card bdy -->
        </div>
    </div>
</div>


