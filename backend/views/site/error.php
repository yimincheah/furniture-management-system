<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>

<div id="content" class="404page">
    <div class="container-fluid">
        <div class="row">
            <div class="not_found">
                    <a href="index.html">
                        <img src="../../image/logo/logo.png" alt="logo">
                    </a>
                    
                    <h2>page not found</h2>
                    <h1 class="font-accent">4<span>0</span>4</h1>
                    <p>The page requested couldn't be found - this could be due to a spelling error in the URL or a removed page.</p>
                    <div class=""><?= Html::a('back to home page', ['/'], ['class' => 'btn'])?></div>
            </div>
        </div>
    </div>
</div>