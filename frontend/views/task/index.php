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

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;



if(Yii::$app->user->identity->id) {
       $rrr = '{view} {update} {delete}';
     
}else{
   $rrr = '{view}';
}

if(Yii::$app->controller->action->id != 'user') {

    $rrr = '';
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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'status',
            'prioritet',
            'date_add',
            //'date_end',
            ['attribute' => 'status', 'filter' => \common\models\Task::STATUS, 'value' => @Status],

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