<?php

use common\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
if (Yii::$app->controller->action->id == 'user') {
    $this->title = 'Мои задачи';
}else {
    $this->title = 'Задачи';
}

$this->params['breadcrumbs'][] = $this->title;



if (!Yii::$app->user->isGuest) {
       $rrr = '{view} {update} {delete}';
     
}else{
   $rrr = '{view}';
}

if(Yii::$app->controller->action->id != 'user') {

    $rrr = '{view}';
}

?>
<div class="task-index">
    <div style="width:100%; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 10px;">
        <h1 style="font-weight: 400;">
            <?= Html::encode($this->title) ?>

        </h1>       
        <p>
            <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-primary custom-btn']) ?>
        </p>
    </div>

    <?php Pjax::begin(); ?>
    <?php

    // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            // 'status',
            ['attribute' => 'prioritet', 'filter' => \common\models\Task::PRIORITET, 'value' => @Prioritet],
            'date_add',
            //'date_end',
            ['attribute' => 'status', 'filter' => \common\models\Task::STATUS, 'value' => @Status],
            ['attribute'=>'author','filter'=>$users, 'format'=>'raw','value'=> 
            function($data) {
              return '<span class="author_email">'.$data['author']['username'].'</span>';
            },
            'filterInputOptions' => [
                'class' => 'form-control author_input', 
                'id' => null,
             ],
            ],
            ['attribute'=>'customer', 'filter'=>$users, 'format'=>'raw','value'=> 
                function($data) {
                return '<span class="author_email">'.$data['customer']['username'].'</span>';
                },
                'filterInputOptions' => [
                    'class' => 'form-control author_input', 
                    'id' => null,
                ],
            ],
            // 'text:text',
            // 'ocenka_truda',
            // 'user_id',
            // 'readliness',
            [
                'class' => ActionColumn::className(),
                'template' => $rrr,
                // 'buttons' => '',
    
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>