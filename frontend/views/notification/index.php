<?php

use common\models\Notification;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\NotificationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Уведомления';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/assest_all/calendar/jquery-ui.css');
$this->registerJsFile(
    '/assest_all/calendar/jquery-ui.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="notification-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'user_id',
                'filter' => $users,
                'format' => 'raw',
                'value' =>
                function ($data) {
                    return '<span class="author_email">' . $data['author']['username']. '</span>';
                    
                },
                'filterInputOptions' => [
                    'class' => 'form-control author_input',
                    'id' => null,
                ],
            ],
            'text:ntext',
            ['attribute'=>'date_add', 
            'filterInputOptions' => [
              'class' => 'form-control  datepicker index',
              'id' => false,
              'autocomplete' => 'off',

          ],
          ],
          ['attribute' => 'flag', 'filter' => \common\models\Notification::FLAG, 'value' => @FLag],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Notification $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            
        ],
    ]); ?>
    

    <?php Pjax::end(); ?>

</div>
