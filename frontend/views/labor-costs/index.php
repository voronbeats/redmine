<?php

use common\models\LaborCosts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use common\models\User;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\LaborCostsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Трудозатраты';
$this->params['breadcrumbs'][] = $this->title;
 
?>
<div class="labor-costs-index">

<div class="center">
        <h1 style="font-weight: 400;"><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Создание трудозатрат', ['create'], ['class' => 'btn btn-primary custom-btn']) ?>
        </p>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'user_id',
            'date',
            'comment:ntext',
            'time',
            'task_id',

            
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                // 'buttons' => '',
    
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
