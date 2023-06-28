<?php

namespace frontend\widget\UpdateCom;

use common\models\Task;
use yii\base\Widget;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use Yii;
use yii\helpers\Url;
use common\models\Comments;
class Update extends Widget


{
    public $id;
    function run () {
        $model = $this->findModel($this->id);

        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post()) && $model->save()) {
           echo 111;
        }
    
        return $this->render('index', [
            'model' => $model
        ]);
        
    }

    
    protected function findModel($id)
    {
        if (($model = Comments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}

?>
