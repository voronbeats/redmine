<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\Url;
use frontend\widget\Com\Com;
/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Задачи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? if($model->user_id == Yii::$app->user->id || $model->author_id == Yii::$app->user->id) {?>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <? } ?>
    </p>
            
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',      
            'date_add',
            'date_end',
            'text:text',
            'ocenka_truda',
            'Prioritet',
            'Status',

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
  
<?=Com::widget()?>

</div>
