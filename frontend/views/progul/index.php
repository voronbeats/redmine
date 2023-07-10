<?php

use common\models\Progul;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\ProgulSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Прогулы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="progul-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Объявить прогул', ['create'], ['class' => 'btn btn-success prog']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            [
                'attribute' => 'user_id',
                'filter' => $users,
                'format' => 'raw',
            ],
            'date',
            'text:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Progul $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
