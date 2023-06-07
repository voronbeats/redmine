<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Task $model */


$this->title = 'Обновление задачу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мои задачи', 'url' => ['user']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'users' => $users,
        'model' => $model,
    ]) ?>

</div>
