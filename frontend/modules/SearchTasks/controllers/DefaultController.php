<?php

namespace frontend\modules\SearchTasks\controllers;
use Yii;
use yii\web\Controller;
use common\models\Task;

/**
 * Default controller for the `SearchTasks` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($text)
    {   
        $models = Task::find()->where(['id'=>$text])->orWhere(['LIKE','name',$text])->all();
        $this->layout = false;
        return $this->render('index', compact('models'));
    }
}
