<?php

namespace frontend\controllers;
use common\models\User;
use common\models\LaborCosts;
use common\models\LaborCostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Task;
use Yii;
/**
 * LaborCostsController implements the CRUD actions for LaborCosts model.
 */
class LaborCostsController extends Controller
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
     * Lists all LaborCosts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = $this->findUser();
        $searchModel = new LaborCostsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users
        ]);
    }

    /**
     * Displays a single LaborCosts model.
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
     * Creates a new LaborCosts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id = false)
    {

        $task = Task::findOne($id);

        $model = new LaborCosts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'task' => $task
        ]);
    }

    /**
     * Updates an existing LaborCosts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionStatics() {
        
        $users = $this->findUsersAll();
        $searchModel = new LaborCostsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('statics', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }

    /**
     * Deletes an existing LaborCosts model.
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

    /**
     * Finds the LaborCosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LaborCosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LaborCosts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findUser()
    {
        if (($model = User::find()->select(['id', 'username'])->asArray()->All())) {
            foreach ($model as $res) {
                $array[$res['id']] = $res['username'];

            }

            return $array;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    
    protected function findUsersAll()
    {
        if ($models = User::find()->All()) {

            return $models;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


