<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\base\DynamicModel;

class AjaxController extends Controller
{
	public function actionSaveRedactorImg($sub)
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isPost) {
            $dir = Yii::getAlias('@images_all').'/'.$sub.'/';
        if (!file_exists($dir)) {
                FileHelper::createDirectory($dir);
            }
        // $result_link = Url::home(true) . 'uploads/images/' . $sub . '/';

            $result_link = Url::home(true).'images_all/'.$sub.'/';
            $file = UploadedFile::getInstanceByName('file');
            $model = new DynamicModel(compact('file'));
            $model->addRule('file', 'image')->validate();

            if ($model->hasErrors()) {
                $result = [
                    'error' => $model->getFirstError('file')
                ];
            } else {
				//Имя файла
                $model->file->name = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . 
				$model->file->extension;
                if ($model->file->saveAs($dir . $model->file->name)) {
					
                $imag = Yii::$app->image->load($dir . $model->file->name);
                $imag -> resize (800, NULL, Yii\image\drivers\Image::PRECISE)
                ->save($dir . $model->file->name, 85); 
                    $result = ['filelink' => $result_link . $model->file->name,'filename' => $model->file->name];
					
                } else {
                    $result = [
                        'error' => Yii::t('vova07/imperavi', 'ERROR_CAN_NOT_UPLOAD_FILE')
                    ];
                }
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
           
		   return $result;
        } else {
            throw new BadRequestHttpException('Only POST is allowed');
        }
    }
	
	public function actionImgDel($file, $act)
    {
		
        if($act == 'article') {
	         $dir = Yii::getAlias('@images_all').'/'.$act.'/'.pathinfo($file , PATHINFO_BASENAME );
        }

        @unlink($dir);
		return 'Изображение удалено с сервера';	
	}
	
}
