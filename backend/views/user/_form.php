<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use borales\extensions\phoneInput\PhoneInput;

$this->registerJsFile(Yii::getAlias('@web') . '/vendor/jquery/jquery.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]);?>
  
    <?=$form->errorSummary($model) ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 255])->label(false); ?>
    
    <div class="form-group field-upload_files">
        <label class="control-label" for="upload_files[]">Profile Picture</label>
        <div>
        <?= FileInput::widget([
                    'name' => 'upload_ajax[]',
                    'options' => ['multiple' => true,'accept' => 'image/*'],
                    'pluginOptions' => [
                        'overwriteInitial'=>false,
                        'initialPreviewShowDelete'=>true,
                        'initialPreview'=> $initialPreview,
                        'initialPreviewConfig'=> $initialPreviewConfig,
                        //'uploadUrl' => Url::to('index.php?r=user/upload-ajax'),
                        //'deleteUrl' => Url::to('index.php?r=user/deletefile-ajax'),
                        'uploadExtraData' => [
                            'ref' => $model->ref,
                        ],
                        'maxFileCount' => 1,
                        'uploadAsync' => false,
                        'showCaption' => false,
                        'showUpload' => false,
                        'showRemove' => false,
                        'showBrowse' => true,
                        'showCancel' => false,   
                        'showZoom' => false,                         
                        'showUploadedThumbs' => false,
                        'validateInitialCount' => true,
                        'overwriteInitial' => false,
                        'browseClass' => 'btn btn-success',
                        'browseIcon' => '<i class="fa fa-camera"></i> ',
                        'browseLabel' => 'Select',
                        'allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg'],
                        'layoutTemplates' => [
                            'actions' => '<div class="file-actions"><div class="file-footer-buttons">{delete} {zoom} </div> <div class="clearfix"></div></div>',
                            'actionDelete' => '<button type="button" class="kv-file-remove btn-sm btn-kv btn-default btn-outline-secondary" title="{removeTitle}"{dataUrl}{dataKey}>{removeIcon}</button>',
                            //'actionUpload' => '<button type="button" class="kv-file-upload btn-sm btn-kv btn-default btn-outline-secondary" title="{uploadTitle}">{uploadIcon}</button>',
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
                            if(count <= 1){
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

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <label>Contact No</label>
    <?= $form->field($model, 'contactNo')->widget(
        PhoneInput::className(), [
        'jsOptions' => [
            'preferredCountries' =>['my'],
        ],
        'defaultOptions' => [
            'class' => 'form-control',
            'max-length' => '255'
        ]
    ])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['view', 'id' => $model->id], ['class'=>'btn', 'style' => 'background-color:black']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

