<?php

namespace frontend\widget\Com;


use common\models\Task;
use yii\base\Widget;
use yii\widgets\ActiveForm;
use Yii;
use yii\helpers\Url;
use common\models\Comments;
class Com extends Widget
{
    public $task_id;
    function run () {

        $commentsAll = $this->findComments();
        $model = new Comments();
        $save = false;
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $commentsAll = $this->findComments();
                $save  = true;
            }
        } else {
            $model->loadDefaultValues();
        }
        
        return $this->render('index', [
            'model' => $model,
            'save' => $save,
            'comments' => $commentsAll
            
        ]);
        
    }

    

    function findComments() {
        if ($comments = Comments::find()->where(['task_id' => $this->task_id])->orderBy(['id' => SORT_DESC])->All()) {
            return $comments;
        }
        return '';
    } 
    
}

?>
