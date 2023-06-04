<?php

namespace backend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
// Подключение к модели, которая соединяется с базой данных
use common\models\Test;

/**
 * Site controller
 */
class TestController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionIndex($category) {
        }
}