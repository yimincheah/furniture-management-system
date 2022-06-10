
<?php

use yii\widgets\ActiveForm;
use dosamigos\chartjs\ChartJs;


$this->title = 'Statistic';
?>

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Total Earnings For Year 
                    <?php $form = ActiveForm::begin(); ?>
                    <?=
                    $form->field($model, 'created_at')->dropDownList(
                        \yii\helpers\ArrayHelper::map($totalEarningByYear, 'year','year'), [
                        'prompt' => 'Select',
                        'onchange' => 'showYearEarning(this);',
                        'class' => 'form-control'
                    ])->label(false);
                    ?>
                    </select>
                    <?php ActiveForm::end(); ?>
                </h6>
            </div>
            <!-- Card Body -->
            <?= ChartJs::widget([
                'id' => 'line2',
                'type' => 'line',
                'options' => [
                    'height' => 30,
                    'width' => 50
                ],
                'data' => [
                    'labels' => '',
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
                            'data' => ''
                        ],
                        
                    ]
                ]
            ]);
            ?>
            <!-- end card bdy -->
        </div>
    </div>
</div>

<script>
    function showYearEarning(year) {
        if(year.value != null && year.value != ''){
            $.ajax({
                url: "/statistic/get-year?id=" + year.value, success: function (result) {
                    var emp = [];
                    var groups = [];
                    alert(result);
                    for(var i in result) {
                        emp.push(" " +result[i].month);
                        groups.push(data[i]);
                    }

                }
            });
        }
    }
</script>

"kartik-v/yii2-date-range": "dev-master",
"jino5577/yii2-date-range-picker": "*",
"kartik-v/yii2-field-range": "*",
"kartik-v/yii2-widget-datepicker":"*",