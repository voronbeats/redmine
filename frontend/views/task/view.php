<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\Url;
use common\models\Task;
use frontend\widget\Com\Com;
/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои задачи', 'url' => ['user']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="task-view container">

    <h5 class="zadacha"><?= Html::encode($this->title) ?></h5>

    <p>
        
        <? if($model->user_id == Yii::$app->user->id || $model->author_id == Yii::$app->user->id) {?>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary test']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger test test2',
            'data' => [ 
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
            <?= Html::a('Трудозатраты', ['labor-costs/create', 'id' => $model->id], ['class' => 'btn btn-success test test3']) ?>
        <? } ?>
    </p>
            
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute'=>'author','format'=>'raw','value'=> 
                function($data) {
                    return $data['author']['username'];
            },
            ], 
            ['attribute'=>'customer','format'=>'raw','value'=> 
                function($data) {
                    return $data['customer']['username'];
                },
            ],
            'name', 
            'text:raw',  
            'Status',   
            'Prioritet',
            'date_add',
            'date_end',
            'ocenka_truda',
            'readliness',
        ],
    ]) ?>

<? if($model->parent) {?>
    <br><h2>Подзадачи:</h2>
    <ul>
    <? foreach($model->parent as $res) {?>   
        <li><a href="<?=Url::to(['task/view', 'id'=>$res->id]);?>"><?=$res->name?></a></li>
    <? }?>
    </ul>
<?}?>



<h3>Комментарии</h3>
<?=Com::widget(['task_id' => $model->id])?>

</div>
