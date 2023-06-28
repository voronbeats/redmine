<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use yii\helpers\Url;
use common\models\Task;
use frontend\widget\Com\Com;
use frontend\widget\Autocomplete;
use yii\widgets\Pjax;
use frontend\widget\UpdateCom\update;

/** @var yii\web\View $this */
/** @var common\models\Task $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои задачи', 'url' => ['user']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


?>
<div class="task-view container" data-id="<?= $model->id ?>">

    <h5 class="zadacha">
        <?= Html::encode($this->title) ?>
    </h5>

    <p>

        <? if ($model->user_id == Yii::$app->user->id || $model->author_id == Yii::$app->user->id) { ?>
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
            'name',
            'date_add',
            'date_end',
            'text:raw',
            'ocenka_truda',
            'Prioritet',
            'Status',

            [
                'attribute' => 'author',
                'format' => 'raw',
                'value' =>
                function ($data) {
            return $data['author']['username'];
        },
            ],
            [
                'attribute' => 'customer',
                'format' => 'raw',
                'value' =>
                function ($data) {
            return $data['customer']['username'];
        },
            ],
            'readliness',
        ],
    ]) ?>

    <h2>Подзадачи</h2>

    <?= Autocomplete::widget() ?>
    <input type="hidden" class="task-id" />
    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success child-add']) ?>

    <?php Pjax::begin(['id' => 'pjaxchild']); ?>
    <? if ($model->parent) { ?>
        <ul>
            <? foreach ($model->parent as $res) { ?>
                <li class="child-name"><a href="<?= Url::to(['task/view', 'id' => $res->id]); ?>" data-pjax = 0 target="_blank">#<?=$res->id?> - <?= $res->name ?></a></li>
            <? } ?>
        </ul>
    <? } ?>
    <?php Pjax::end(); ?>

    <h3>Комментарии</h3>
    <?= Com::widget(['task_id' => $model->id, 'modelTask' => $model]) ?>

</div>