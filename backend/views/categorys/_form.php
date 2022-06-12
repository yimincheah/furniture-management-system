<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);
?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => 'Status']) ?>

    <div class="form-group">

        <?php if ($model->isNewRecord) { ?>
            <?= Html::submitButton('Save', ['class' => 'btn']) ?>

        <?php } else { ?>
            <?= Html::submitButton('Update', ['class' => 'btn']) ?>

        <?php } ?>

        <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->category_id], ['class' => 'btn', 'style' => 'background-color:black']) ?>

    </div>

    <?php ActiveForm::end(); ?>

