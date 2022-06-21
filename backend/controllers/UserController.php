<?php

namespace backend\controllers;

use backend\models\User;
use backend\models\Uploads;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\filters\AccessControl;
use Yii;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['view','update','_form', 'upload-ajax', 'deletefile-ajax'],
                            'allow' => true,
                            'roles' => ['admin','staff'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $upload = Uploads::find()->where(['ref'=>$model->ref])->asArray()->all();	

        return $this->render('view', [
            'model' => $model,
            'upload' => $upload,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(empty($model->ref))
        {
            if ($model->load(Yii::$app->request->post()) ) {

                $this->Uploads(false);
    
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
    
            } else {
                $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
            }

        }
        else {
            
            list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);
        
            if ($model->load(Yii::$app->request->post())) {
                $this->Uploads(false);
    
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'initialPreview'=>empty($initialPreview)? '' : $initialPreview,
            'initialPreviewConfig'=>empty($initialPreviewConfig)? '' : $initialPreviewConfig
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


/*|*********************************************************************************|
|================================ Upload Ajax ====================================|
|*********************************************************************************|*/

    public function actionUploadAjax()
    {   
        $this->Uploads(true);
    }

    private function CreateDir($folderName)
    {
        if($folderName != NULL){
            $basePath = User::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir)
    {
        BaseFileHelper::removeDirectory(User::getUploadPath().$dir);
    }

    private function Uploads($isAjax=false) 
    {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
    
            if ($images) {

                if($isAjax===true){
                    $ref =Yii::$app->request->post('ref');
                }else{
                    $photoUser = Yii::$app->request->post('User');
                    $ref = $photoUser['ref'];
                }
        
                $this->CreateDir($ref);

                foreach ($images as $file){
                    $fileName       = $file->baseName . '.' . $file->extension;
                    $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                    $savePath       = User::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                    if($file->saveAs($savePath)){

                        if($this->isImage(Url::base(true).'/'.$savePath)){
                            $this->createThumbnail($ref,$realFileName);
                        }
            
                        $model                  = new Uploads;
                        $model->ref             = $ref;
                        $model->file_name       = $fileName;
                        $model->real_filename   = $realFileName;
                        $model->save(); 

                        if($isAjax===true){
                            echo json_encode(['success' => 'true']);
                        }
                        
                    }else{
                        if($isAjax===true){
                            echo json_encode(['success'=>'false','eror'=>$file->error]);
                        }
                    }
                }
            }
        }
    }

    private function getInitialPreview($ref) 
    {
        $datas = Uploads::find()->where(['ref'=>$ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption'=> $value->file_name,
                'width'  => '120px',
                'url'    => Url::to('index/php?r=user/deletefile-ajax'),
                'key'    => $value->upload_id
            ]);
        }
        return  [$initialPreview,$initialPreviewConfig];
    }

    public function isImage($filePath)
    {
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model)
    {     
        $filePath = User::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
        $isImage  = $this->isImage($filePath);
        if($isImage){
            $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
        }else{
            $file =  "<div class='file-preview-other'> " .
                        "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                        "</div>";
        }
        return $file;
    }

    private function createThumbnail($folderName,$fileName)
    {
        $uploadPath   = User::getUploadPath().'/'.$folderName.'/'; 
        $file         = $uploadPath.$fileName;
        $image        = Yii::$app->image->load($file);
        $image->save($uploadPath.'thumbnail/'.$fileName);
        return;
    }

    public function actionDeletefileAjax()
    {
        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename  = User::getUploadPath().$model->ref.'/'.$model->real_filename;
            $thumbnail = User::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
            if($model->delete()){
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success'=>true]);
            }else{
                echo json_encode(['success'=>false]);
            }
        }else{
            echo json_encode(['success'=>false]);  
        }
    }  
}

