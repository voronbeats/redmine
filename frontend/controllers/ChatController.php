<?php

namespace frontend\controllers;

use common\models\Chat;
use common\models\ChatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Chat models.
     *
     * @return string
     */


    /**
     * Displays a single Chat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionIndex()
    {
        $users = $this->findUser();
        $message = $this->findMessage();
        $model = new Chat();      


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) { 

                $users = $this->findUser();    
                $message = $this->findMessage();
                $model = new Chat();             
                return $this->render('chat', [
                    'users' => $users,
                    'model' => $model,
                    'message' => $message,
                ]);   

            }
        } else {
            $model->loadDefaultValues();
        } 


        $message = $this->findMessage();
        return $this->render('Chat', [
            'users' => $users,
            'model' => $model,
            'message' => $message,
        ]);
    }

    

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findUser()
    {
        if ($ids = User::find()->all()) {
            return $ids;
        }
    }

    protected function findMessage() {
        if($message = Chat::find()->limit('20')->orderBy(['id' => SORT_DESC])->all()) {
            $message = array_reverse($message);
            return $message;
        }
        
    }
}
