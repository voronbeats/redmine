<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
// Подключение к модели, которая соединяется с базой данных
use common\models\News;

/**
 * Site controller
 */
class NewsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionIndex($category) {
        
        $model = new News();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

        public function actionForm() {
            echo '111';
        }
    
}

