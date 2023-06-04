<?php

namespace frontend\widget;

use common\models\Task;
use yii\base\Widget;
use yii\helpers\Html;


class Autocomplete extends Widget 
{
    public $task_id;
    public function run() {
        if($this->task_id) {
            if(!$taskName = Task::findOne($this->task_id)) {
                $taskName = false;
            }else{
                $taskName = $taskName['name'];
            }
        }else{
            $taskName = false;
        }
    
        return $this->render('index', ['taskName' => $taskName]);
    }
    
}
?>