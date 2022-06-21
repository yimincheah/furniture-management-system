<?php

use yii\web\JsExpression;
use yii\helpers\Html;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);

$this->title = 'Schedule';

?>



<?php 
$JSEventClick = <<<EOF
function(calEvent, jsEvent, view) {
window.open('?r=staff/view-order&id='+calEvent.id);
return false;
}
EOF;
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                    <h2>Schedule</h2>
                    <ul>
                        <li><?= Html::a('Home', ['/']) ?></li>
                        <li><?= Html::a('Schedule', ['/staff/schedule']) ?></li>
                    </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">

    <div class="container-fluid">

    <?= \yii2fullcalendar\yii2fullcalendar::widget([
        'events'=>$events,
        'clientOptions'=>[
            'height'=>'auto',
            'timeFormat' => 'H:mm',
            'header'=>[
                'right'=>'',   
            ],
            'eventClick' => new JsExpression($JSEventClick), 
        ]
    ]);
    ?>
    </div>
</div>