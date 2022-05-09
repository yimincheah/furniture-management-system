<?php

use yii\helpers\Html;

$this->title = 'Manage Schedule';
?>

<!-- breadcrumb -->
<section class="main_breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="breadcrumb-content">
                    <h2>Manage Schedule</h2>
                    <ul>
                        <li><?= Html::a('Home', ['/']) ?></li>
                        <li><?= Html::a('Schedule', ['/schedule/index']) ?></li>
                    </ul>
            </div>
        </div>
    </div>
</section>

<div class="container" id="content">

    <div class="container-fluid">

    <h1>Assign Staff</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>

</div>