<?php

namespace frontend\widget\Com;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use Yii;
use yii\helpers\Url;
use common\models\Comments;
class Com extends Widget
{

    function run () {
        $model = new Comments();
 
        $save = false;
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $save  = true;
            }
        } else {
            $model->loadDefaultValues();
        }


        return $this->render('index', [
            'model' => $model,
            'save' => $save,
        ]);
            
    }
}
		


?>
