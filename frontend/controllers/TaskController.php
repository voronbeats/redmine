<?php

namespace frontend\controllers;

use common\models\Task;
use common\models\User;
use common\models\Tgram;
use common\models\TaskSearch;
use yii\web\Controller;
use yii\web\JsExpression;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use Event;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Lists all Task models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = $this->findUser();
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users
        ]);
    }
    public function actionUser()
    {
        /*$model->user->user_id*/
        // return $this->render('user'); 

        $users = $this->findUser();
        $searchModel = new TaskSearch();

        if (!Yii::$app->user->id) {

            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = $searchModel->search($this->request->queryParams, Yii::$app->user->id, 'User');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users
        ]);
    }



    /**
     * Displays a single Task model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Task();

        $users = $this->findUser();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'users' => $users,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $users = $this->findUser();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'users' => $users,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionGrade() {
        $users = $this->arraySumUsers();
        return $this->render('grade', [
            'users' => $users,
        ]);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */




    protected function arraySumUsers() {
        $users = $this->findUser($asArray = false);
        foreach($users as $user) {
            $arraySum[] = count($user->taskexit);
        }
        $sum = array_sum($arraySum);
        if($sum == '0') {
            return ;
        }
        $usersResult = '';
        foreach($users as $user) {
            $usersResult .= $this->userProcent( $sum, count($user->taskexit), $user->username);
        }

        return rtrim($usersResult, ",");
    }
    protected function userProcent($sum, $count, $username)
    {

        $result = 100*$count/$sum;
        return '["'.$username.'", '.$result.'],';
    }
    protected function findModel($id)
    {
        if (($model = Task::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findUser($asArray = true)
    {
         $query= User::find();
        if($asArray) {
            $query->select(['id', 'username'])->asArray();
        }else{
            $model = $query->all();
            return $model;
        }
        $model = $query->All();
        if ($model) {
            foreach ($model as $res) {
                $array[$res['id']] = $res['username'];
            }

            return $array;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}