<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use backend\models\Brands;
use backend\models\Categorys;
use kartik\file\FileInput;
use yii\helpers\Url;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::class]]);

?>
<style>

</style>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?=$form->errorSummary($model) ?>
    
    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 255])->label(false); ?>
    
    <div class="form-group field-upload_files">
        <label class="control-label" for="upload_files[]">Product Image</label>
        <div>
        <?= FileInput::widget([
            'name' => 'upload_ajax[]',
            'options' => ['multiple' => true,'accept' => 'image/*'],
            'pluginOptions' => [
                'overwriteInitial'=>false,
                'initialPreview'=> $initialPreview,
                'initialPreviewConfig'=> $initialPreviewConfig,
                'uploadExtraData' => [
                    'ref' => $model->ref,
                ],
                'uploadUrl' => Url::to('index.php?r=products/upload-ajax'),
                'deleteUrl' => Url::to('index.php?r=products/deletefile-ajax'),
                'maxFileCount' => 6,
                'uploadAsync' => true,
                'showCaption' => false,
                'showUpload' => true,
                'showRemove' => false,
                'showBrowse' => true,
                'showCancel' => false,   
                'showZoom' => false,   
                'browseOnZoneClick' => true, 
                'showUploadedThumbs' => true,               
                'validateInitialCount' => true,
                'browseClass' => 'btn btn-success',
                'browseIcon' => '<i class="fa fa-camera"></i> ',
                'browseLabel' => 'Select',
                'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg'],
                'layoutTemplates' => [
                    'actions' => '<div class="file-actions"><div class="file-footer-buttons"> {upload} {delete} {zoom} </div> <div class="clearfix"></div></div>',
                    'actionDelete' => '<button type="button" class="kv-file-remove btn-sm btn-kv btn-default btn-outline-secondary" title="{removeTitle}"{dataUrl}{dataKey}>{removeIcon}</button>',
                    'actionUpload' => '<button type="button" class="kv-file-upload btn-sm btn-kv btn-default btn-outline-secondary" title="{uploadTitle}">{uploadIcon}</button>',
                    'actionZoom' => '<button type="button" class="kv-file-zoom btn-sm btn-kv btn-default btn-outline-secondary" title="{zoomTitle}">{zoomIcon}</button>',
                    'modalMain' => '<div id="kvFileinputModal" class="file-zoom-dialog modal fade" tabindex="-1" aria-labelledby="kvFileinputModalLabel"></div>',
                    'modal' => '<div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                <div class="kv-zoom-actions pull-right">{close}</div>
                                <h3 class="modal-title"><small><span class="kv-zoom-title"></span></small></h3>
                                </div>
                                <div class="modal-body">
                                <div class="floating-buttons"></div>
                                <div class="kv-zoom-body file-zoom-content"></div>{prev} {next} </div></div></div>',
                ],
                'previewZoomButtonClasses' => [
                    'close' => 'btn-sm btn-kv btn-default btn-outline-secondary btn-kv-close'
                ],
                'msgFilesTooMany' => 'Number of files selected for upload ({n}) exceeds maximum allowed limit of {m}. Please retry your upload!', 
            ],
            'pluginEvents' => [
                'filebatchselected' => 'function() {
                    var count = $("#input-id").fileinput("getFilesCount");   
                    if(count <= 6){
                        $(this).fileinput("upload");
                    }
                    else{
                        return false;
                    }
                }', 
            ]  
                        
        ]);
        ?>
        </div>
    </div>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_price')->textInput() ?>

    <?= 
        $form->field($model, 'brand_id')->widget(Select2::class, [
        'data' =>  Brands::getBrandList(),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a brand'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]);
    ?>

    <?= 
        $form->field($model, 'category_id')->widget(Select2::class, [
        'data' =>  Categorys::getCategoryList(),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a category'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        ]);
    ?>

    <?=
        $form->field($model, 'product_status')->widget(SwitchInput::class, [
            'value' => (isset($model->product_status) && $model->product_status == 'active') ? true : false,
            'pluginOptions' => [
                'onText' => '<i class="fa fa-check"></i>',
                'offText' => '<i class="fa fa-times"></i>',
                'size' => 'medium',
                'handleWidth'=>20,
            ]
        ]);
 
    ?>

    <br>
    <div class="form-group">
       
       <?php if($model->isNewRecord){ ?>
           <?= Html::submitButton('Save', ['class' => 'btn']) ?>
       
       <?php } 
       else{ ?>
           <?= Html::submitButton('Update', ['class' => 'btn']) ?>
           
       <?php }?>
   
       <?= Html::a(Yii::t('app', 'Cancel'), ['index', 'id' => $model->product_id], ['class'=>'btn', 'style' => 'background-color:black']) ?>
       
   </div>

    <?php ActiveForm::end(); ?>

</div>
